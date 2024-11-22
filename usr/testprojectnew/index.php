<?php

use PhpOffice\PhpWord\TemplateProcessor;

require "vendor/autoload.php";

$templateProcessor =  new PhpOffice\PhpWord\TemplateProcessor('plantillas/solicitud.docx');

$templateProcessor->setValues(
    ['nombreCompleto'=>'Isis Nayeli Centeno Madrid',
    'direccion'=> 'Isis Nayeli Centeno Madrid'
]);
//$templateProcessor->setImageValue();

// Guardar el documento rellenado
$pathToSave = 'uwu.docx';
$templateProcessor->saveAs($pathToSave);

header('Content-Description: File Transfer');
header('Content-Disposition: attachment; filename=uwu.docx');
header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');

readfile($pathToSave);
?>
