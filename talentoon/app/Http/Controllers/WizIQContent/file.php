<?php
class file
{
    function file($secretAcessKey,$access_key,$webServiceUrl)
    {
        echo '<form id="form1" action="UploadContent.php" method="POST"
                enctype="multipart/form-data">
        <br />
        <br />
        Enter File name to upload <input name="filename" type="text"
                id="txtName"> <br />
        <br />

        <input name="submit" type="submit" value="Upload">
<input type="hidden" name="secretAcessKey" id="secretAcessKey" value="'.$secretAcessKey.'">
<input type="hidden" name="access_key" id="access_key" value="'.$access_key.'">
<input type="hidden" name="webServiceUrl" id="webServiceUrl" value="'.$webServiceUrl.'">
</form>

        ';
    }
}
?>