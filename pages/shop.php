<?php include '../includes/header.php'; ?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Picture Gallery</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
       
        .gallery-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 20px;
        }

        
        .image-description {
            font-size: 18px;
            color: #333;
            margin-bottom: 10px;
            text-align: center;
            font-weight: bold;
        }

        
        .large-image {
            width: 30%; 
            height: 550%;
            margin-top: 50px; 
            margin-bottom: 10px; 
            border: 2px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        
        .thumbnails {
            display: flex;
            gap: 20px;
            justify-content: center;
            margin-top: 10px; 
        }

        .thumbnail-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .thumbnail-item img {
            width: 100px; 
            height: 100px; 
            object-fit: cover; 
            border: 2px solid #ccc;
            border-radius: 8px;
            cursor: pointer;
            transition: transform 0.3s, border-color 0.3s;
            margin-bottom: 5px; 
        }

        .thumbnail-item img:hover {
            transform: scale(1.1);
            border-color: #333;
        }
    </style>
</head>
<body>
    <div class="gallery-container">
        
        <div id="imageDescription" class="image-description">ملابس شتوية</div>

        
        <img id="largeImage" class="large-image" src="../images/winter.png" alt="Winter Clothes">

        
        <div class="thumbnails">
            <div class="thumbnail-item">
                <img src="../images/winter.png" alt="Winter Clothes" data-large="../images/winter.png" data-description="ملابس شتوية">
                <p>ملابس شتوية</p>
            </div>
            <div class="thumbnail-item">
                <img src="../images/summer.png" alt="Summer Clothes" data-large="../images/summer.png" data-description="ملابس صيفية">
                <p>ملابس صيفية</p>
            </div>
            <div class="thumbnail-item">
                <img src="../images/sport1.png" alt="Sports Clothes" data-large="../images/sport1.png" data-description="ملابس رياضية">
                <p>ملابس رياضية</p>
            </div>
        </div>
    </div>

    <script>
        
        document.addEventListener("DOMContentLoaded", function () {
            const largeImage = document.getElementById("largeImage");
            const imageDescription = document.getElementById("imageDescription");
            const thumbnails = document.querySelectorAll(".thumbnail-item img");

            thumbnails.forEach(thumbnail => {
                thumbnail.addEventListener("click", function () {
                    const newSrc = this.getAttribute("data-large");
                    const newDescription = this.getAttribute("data-description");

                    
                    largeImage.src = newSrc;
                    largeImage.alt = this.alt;

                    
                    imageDescription.textContent = newDescription;
                });
            });
        });
    </script>

<?php include '../includes/footer.php'; ?>
</body>
</html>