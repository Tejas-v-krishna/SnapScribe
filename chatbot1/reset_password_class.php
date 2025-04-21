<?php
/**
 * Password Reset Handler Class
 * 
 * This class manages password reset functionality
 * with validation, secure token generation, and database operations
 */
class PasswordReset {
    private $conn;
    private $table = 'password_resets';
    
    /**
     * Constructor - initialize with database connection
     * 
     * @param mysqli $conn Database connection object
     */
    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    /**
     * Validate if email exists in the users table
     * 
     * @param string $email User email to validate
     * @return bool True if email exists, false otherwise
     */
    public function validateEmail($email) {
        $email = $this->conn->real_escape_string($email);
        $query = "SELECT id FROM users WHERE email = '$email'";
        $result = $this->conn->query($query);
        
        return $result->num_rows > 0;
    }
    
    /**
     * Generate a secure random token
     * 
     * @return string The generated token
     */
    public function generateToken() {
        // Generate 32 bytes of random data and convert to hex
        return bin2hex(random_bytes(32));
    }
    
    /**
     * Create a password reset token for a user
     * 
     * @param string $email User email
     * @return string|bool Token string if successful, false otherwise
     */
    public function createResetToken($email) {
        $email = $this->conn->real_escape_string($email);
        $token = $this->generateToken();
        $expires = date('Y-m-d H:i:s', strtotime('+1 hour'));
        
        // Check if table exists, create if not
        $this->createTableIfNotExists();
        
        // Remove any existing tokens for this email
        $this->deleteExistingTokens($email);
        
        // Insert new token
        $query = "INSERT INTO {$this->table} (email, token, expires_at, created_at) 
                  VALUES ('$email', '$token', '$expires', NOW())";
        
        if ($this->conn->query($query)) {
            return $token;
        }
        
        return false;
    }
    
    /**
     * Validate a token for password reset
     * 
     * @param string $token Reset token
     * @param string $email User email
     * @return bool True if token is valid and not expired, false otherwise
     */
    public function validateToken($token, $email) {
        $token = $this->conn->real_escape_string($token);
        $email = $this->conn->real_escape_string($email);
        
        $query = "SELECT * FROM {$this->table} 
                  WHERE token = '$token' AND email = '$email' AND expires_at > NOW()";
        $result = $this->conn->query($query);
        
        return $result->num_rows > 0;
    }
    
    /**
     * Update user password
     * 
     * @param string $email User email
     * @param string $password New password (plain text)
     * @return bool True if password updated successfully, false otherwise
     */
    public function updatePassword($email, $password) {
        $email = $this->conn->real_escape_string($email);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        $query = "UPDATE users SET password = '$hashed_password' WHERE email = '$email'";
        
        if ($this->conn->query($query)) {
            // Delete used tokens
            $this->deleteExistingTokens($email);
            return true;
        }
        
        return false;
    }
    
    /**
     * Create the password_resets table if it doesn't exist
     */
    private function createTableIfNotExists() {
        $query = "CREATE TABLE IF NOT EXISTS {$this->table} (
            id INT AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(255) NOT NULL,
            token VARCHAR(100) NOT NULL,
            expires_at DATETIME NOT NULL,
            created_at DATETIME NOT NULL,
            INDEX (email),
            INDEX (token)
        )";
        
        $this->conn->query($query);
    }
    
    /**
     * Delete existing tokens for a given email
     * 
     * @param string $email User email
     */
    private function deleteExistingTokens($email) {
        $email = $this->conn->real_escape_string($email);
        $query = "DELETE FROM {$this->table} WHERE email = '$email'";
        $this->conn->query($query);
    }
}
?>