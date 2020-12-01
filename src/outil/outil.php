<?php

/**
 * var_dump avec < pre >< / pre > pour le debogage de code
 * 
 * @param mixed $param1 - Tous les types de param sont accepter
 * @param mixed $param2 - (facultative) Tous les types de param sont accepter
 * @param bool $param3  - sur false par défault , permet d'activer ou pas, la function die()
 * 
 * @return void - retourne la valeur de var_dump
 */
function pre_var_dump($param1, $param2 = null, bool $param3 = false) : void
{
    if ($param3 === false) {
        
        if ($param2 === null) {
            echo '<pre>';
            var_dump($param1);
            echo '</pre>';
        }
        else{
            echo '<pre>';
            var_dump($param1, $param2);
            echo '</pre>';
        }
    }else{
        if ($param2 === null) {
            echo '<pre>';
            var_dump($param1);die;
            echo '</pre>';
        }
        else{
            echo '<pre>';
            var_dump($param1, $param2);die;
            echo '</pre>';
        }
    }
}





//////////////////// uploal_file

/**
 * charger une image dans un dossier de l'aplication et le nom de l'image dans la bdd
 * 
 *  @param array $filename - représente letableau de la variable $_FILES pour l'input de type file
 *  @param string $url - ecrire le chemin pour placer l'image dans l'application
 *  @param string $name_input - ecrire le nom de la valeur de l'attribut name pour l'input de type file
 */
function upload_file($filename, $url, $name_input){

    $file_basename = substr($filename, 0, strripos($filename, '.')); // on récupère que le nom du fichier sans l'extention

    $file_ext = substr($filename, strripos($filename, '.')); // on récupère l'extention sans le nom du fichier

    $filesize = $_FILES[$name_input]["size"];

    $rand = rand(0, 100000000);
    $rand2 = rand(0, 100000000);

    $allowed_file_types = array('.doc','.docx','.rtf','.pdf', '.gif', '.jpg', '.png', '.PNG', '.jpeg');	

    if (in_array($file_ext, $allowed_file_types) && ($filesize < 1200000))
    {	
        $first_filename = $file_basename . $file_ext;
        
        $date = new DateTime('now');
        $date = $date->format('Y_m_d_H_i_s');

        if (file_exists("{$url}" . $first_filename))
        {
            
            // si le fichier existe déjà, on renomme le fichier
            $change = md5($file_basename);
            $good_img = $date . $change . $file_ext;
            
            move_uploaded_file($_FILES[$name_input]["tmp_name"], "{$url}" . $good_img );
            echo "success le fichier a été renomé et ajouter car il existe déjà dans ce dossier.";
        }
        else
        {		
            $good_img = $first_filename;
            move_uploaded_file($_FILES[$name_input]["tmp_name"], "{$url}" . $good_img);
            echo "success le fichier est bien ajouter.";		
        }
        return $good_img;
    }
    elseif ($filesize > 1200000)
    {	
        echo "Le fichier est trop large";
    }
    else
    {
        echo "Le fichier doit avoir l'un de ces extentions : " . implode(', ',$allowed_file_types);
        unlink($_FILES[$name_input]["tmp_name"]);
    }

    return $good_img = '';
}



/**
 * faire une redirection
 * 
 * @param string $url - url de destination
 * @param bool $bool  - sur true par défault , permet d'activer ou pas, la function exit()
 * 
 * @return void
 */
function header_location(string $url, bool $bool = true) : void
{
    if($bool === false){
        header("Location: {$url}");
    }
    else{
        header("Location: {$url}");
        exit();
    }
}
