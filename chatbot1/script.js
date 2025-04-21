document.getElementById("extractBtn").addEventListener("click", async () => {
  const fileInput = document.getElementById("imageInput");
  const output = document.getElementById("output");
  const loading = document.getElementById("loading");

  if (!fileInput.files.length) {
    alert("Please upload an image first!");
    return;
  }

  const file = fileInput.files[0];
    // Upload to server
const uploadFormData = new FormData();
uploadFormData.append("file", file);

await fetch("upload_image.php", {
  method: "POST",
  body: uploadFormData
});

  const formData = new FormData();
  formData.append("file", file);
  formData.append("language", "eng");
  formData.append("apikey", "K87751521688957"); // Replace with your actual API key
  formData.append("isOverlayRequired", false);

  loading.classList.remove("hidden");
  output.value = "";

  try {
    const response = await fetch("https://api.ocr.space/parse/image", {
      method: "POST",
      body: formData,
    });

    const result = await response.json();

    if (result.IsErroredOnProcessing) {
      output.value = "Error: " + result.ErrorMessage.join(", ");
    } else {
      const parsedText = result.ParsedResults[0].ParsedText;
      output.value = parsedText;
    }
  } catch (err) {
    output.value = "Failed to process image. Error: " + err.message;
  } finally {
    loading.classList.add("hidden");
  }
});
