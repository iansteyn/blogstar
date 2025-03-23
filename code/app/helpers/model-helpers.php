<?php
/* model-helpers.php
 * ----------------------------------------------------------------------------------
 * Contains utility functions for models.
 * Include this file at the top of a model if you want to use any of these methods.
 * -----------------------------------------------------------------------------------
 */

function addImageMimeType(string $imageString): string {
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mimeType = $finfo->buffer($imageString);
    return 'data:'.$mimeType.';base64,'.base64_encode($imageString);
}
