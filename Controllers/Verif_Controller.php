<?php
class Validator
{
    private $schema;

    public function __construct($schema)
    {
        $this->schema = json_decode($schema, true);
    }

    public function validate($payload)
    {
        $data = json_decode($payload, true);

        if (!$data) {
            return false; 
        }

        return $this->validateDataAgainstSchema($data, $this->schema);
    }

    private function validateDataAgainstSchema($data, $schema)
    {
        if (isset($schema['required'])) {
            foreach ($schema['required'] as $requiredProp) {
                if (!array_key_exists($requiredProp, $data)) {
                    return false;
                }
            }
        }
        
        foreach ($schema['properties'] as $propName => $propSchema) {
            if (array_key_exists($propName, $data)) {
                $propValue = $data[$propName];
                
                if (!$this->validateProperty($propName,$propValue, $propSchema,$data)) {
                    return false;
                }
            }
        }
        
        return true;
    }

    private function validateProperty($name,$value, $schema,$data)
    {   
        
        if (isset($schema['type'])) {
            $type = $schema['type'];
            if ($type === 'string' && !is_string($value)) {
                return false;
            } elseif ($type === 'boolean' && !is_bool($value)) {
                return false;
            } elseif ($type === 'integer' && !is_int($value)) {
                return false;
            } elseif ($type === 'array' && !is_array($value)) {
                return false;
            }
        }
        
        if (isset($schema['enum']) && !in_array($value, $schema['enum'])) {
            return false;
        }

        
        if (isset($schema['minimum']) && $value < $schema['minimum']) {
            return false;
        }

        
        if (isset($schema['minLength']) && strlen($value) < $schema['minLength']) {
            return false;
        }

        
        if (isset($schema['type']) && $schema['type'] === 'array') {
            
            if (isset($schema['minItems']) && count($value) < $schema['minItems']) {
                return false;
            }

            if (isset($schema['items'])) {
                
                foreach ($value as $item) {
                    if (!$this->validateProperty(null,$item, $schema['items'],null)) {
                        return false;
                    }
                }
            }
        }

        // Vérifier si des propriétés non autorisées sont présentes dans les données
        $allowedProperties = array_keys($this->schema['properties']);
        if (is_array($data))
        {
            foreach ($data as $key => $value) {
                if (!in_array($key, $allowedProperties)) {
                    return false; // Propriété non autorisée
                }
            }
        }

         return true;
     }

    
}

if(!empty($_POST) && isset($_POST['btnVerif'])){
    $uploadDirectory = "C:/wamp64/www/exemple2/files/";

    if (isset($_FILES["file1"]) && isset($_FILES["file2"])) 
    {
        $file1 = $_FILES["file1"];
        $file2 = $_FILES["file2"];

        $file1Name = $file1["name"];
        $file2Name = $file2["name"];

        $targetFile1 = $uploadDirectory . basename($file1Name);
        $targetFile2 = $uploadDirectory . basename($file2Name);
        
        // Déplacez les fichiers téléchargés vers le répertoire de stockage
        if (move_uploaded_file($file1["tmp_name"], $targetFile1) && move_uploaded_file($file2["tmp_name"], $targetFile2)) {
            echo "Les fichiers ont été téléchargés avec succès.";
        } else {
            echo "Une erreur s'est produite lors du téléchargement des fichiers.";
        }
    }
    $model = file_get_contents('C:/wamp64/www/exemple2/files/model.json');
    $payloadValid = file_get_contents('C:/wamp64/www/exemple2/files/payloadValid.json');

    $validator = new Validator($model);

    $valid = $validator->validate($payloadValid);

    echo $valid ? 'true' : 'false';

}
?>
