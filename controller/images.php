<?php 
function showImagesInFolder($folderPath) {
    $imageExtensions = ['jpg', 'jpeg', 'png', 'gif']; // Define the allowed image extensions

    $directoryIterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($folderPath));

    $currentSubfolder = '';
    echo '<div class="card">';
    echo '<div class="card-header">' . $folderPath . '</div>';
    echo '<div class="card-body">';
    echo '<div class="image-line">'; // Start the initial image line

    foreach ($directoryIterator as $file) {
        if ($file->isFile()) {
            $extension = strtolower(pathinfo($file->getPathname(), PATHINFO_EXTENSION));
            if (in_array($extension, $imageExtensions)) {
                $relativePath = str_replace($folderPath, '', $file->getPathname());
                $subfolderName = dirname($relativePath);
                if ($subfolderName !== "\default") {
                    if ($subfolderName !== $currentSubfolder) {
                        // Close the previous image line and start a new one for a new subfolder
                        if ($currentSubfolder !== '') {
                            echo '</div>'; // Close the previous image line
                        }
                        echo '<div class="subfolder-line">'; // Start a new subfolder line
                        echo '<div class="subfolder-label">' . $subfolderName . '</div>';
                        echo '<div class="image-line">'; // Start a new image line

                        $currentSubfolder = $subfolderName;
                    }

                    // Display the image within the image line
                    echo '<div class="image-container">';
                    echo '<img src="' . $folderPath . $relativePath . '" alt="' . $relativePath . '" class="img-fluid">';
                    echo '<div class="image-label">' . $relativePath . '</div>';
                    echo '</div>';
                }
            }
        }
    }

    echo '</div>'; // Close the last image line
    echo '</div>'; // Close the last subfolder line
    echo '</div>'; // Close the card body
    echo '</div>'; // Close the card
}





$folderPath = './student-images';
showImagesInFolder($folderPath);
