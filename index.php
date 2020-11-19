<?php
if(isset($_POST['Envoyer'])){
    $xml=new DOMDocument("1.0","utf-8");
    $xml->load("chat.xml");
    $baliseRacine=$xml->getElementsByTagname("messages")->item(0);
    // Message a un contact
    if (empty($_POST['destination'])) {
    echo "ajouter un destinataire";
    }
    if($_POST['destination']=='Fichale KEZIRE' || $_POST['destination']=='Davina DAKO')
    {
    $message=$xml->createElement("message",$_POST['message']);
    $type ="text";
    $message->setAttribute('type', $type);
    $emetteurs = "brahim";
    $emetteur=$xml->createElement("emetteur",$emetteurs);
    $recepteur=$xml->createElement("recepteur");
    $contact=$xml->createElement("contact");
    $contact_nomComplet=$xml->createElement("contact_nomComplet",$_POST['destination']);
    $groupe=$xml->createElement("groupe");
    //if($_POST['destination'] == 'M1-SRT' || $_POST['destination'] == 'M1-GLSI'){
    $nom_groupe=$xml->createElement("nom_groupe"); 
    $nom_fichier = "nom";
    $type_fichier = "";
    $fichier_groupe=$xml->createElement("fichier_groupe");
    $fichier_groupe->setAttribute("type",$type_fichier);
//}
    $groupe->appendChild($nom_groupe);
    $groupe->appendChild($fichier_groupe);
    $contact->appendChild($contact_nomComplet);
    $recepteur->appendChild($contact);
    $recepteur->appendChild($groupe);
    $message->appendChild($emetteur);
    $message->appendChild($recepteur);
    $baliseRacine->appendChild($message);
    $xml->save("chat.xml");
    }
    // message a un groupe
    if($_POST['destination']=='M1-SRT' || $_POST['destination']=='M1-GLSI')
    {
    $message=$xml->createElement("message",$_POST['message']);
    $type ="text";
    $message->setAttribute('type', $type);
    $emetteurs = "brahim";
    $emetteur=$xml->createElement("emetteur",$emetteurs);
    $recepteur=$xml->createElement("recepteur");
    $contact=$xml->createElement("contact");
    $contact_nomComplet=$xml->createElement("contact_nomComplet");
    $groupe=$xml->createElement("groupe");
    //if($_POST['destination'] == 'M1-SRT' || $_POST['destination'] == 'M1-GLSI'){
    $nom_groupe=$xml->createElement("nom_groupe",$_POST['destination']); 
    $nom_fichier = "nom";
    $type_fichier = "";
    $fichier_groupe=$xml->createElement("fichier_groupe");
    $fichier_groupe->setAttribute('type',$type_fichier);
//}
    $groupe->appendChild($nom_groupe);
    $groupe->appendChild($fichier_groupe);
    $contact->appendChild($contact_nomComplet);
    $recepteur->appendChild($contact);
    $recepteur->appendChild($groupe);
    $message->appendChild($emetteur);
    $message->appendChild($recepteur);
    $baliseRacine->appendChild($message);
    $xml->save("chat.xml");
    }
    // si le message est un fichier audio ou un fichier
    $target_dir = "fichier/";
    $target_file = $target_dir . basename($_FILES["fichier"]["name"]);
    $uploadOk = 1;
    $FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if(!empty($FileType)) {
    // verifions la taille du fichier
    if ($_FILES["fichier"]["size"] > 50000000) {
    echo "Fichier est grand.";
    $uploadOk = 0;
    }

    // verifier le format du fichier format autorise .mp3 ou .txt
    if($FileType != "mp3" && $FileType != "txt" && $FileType != "pdf") {
    echo "seul les fichiers audio pdf ou text sont autorise.";
    $uploadOk = 0;
    }
    // verifions si le fichier est bien uploader
    if ($uploadOk == 0) {
    echo "erreur lors de l'envoi du fichier.";
    // sinon tout est ok
    } else {
    if (move_uploaded_file($_FILES["fichier"]["tmp_name"], $target_file)) {
    echo "le fichier ". htmlspecialchars( basename( $_FILES["fichier"]["name"])). " a ete bien envoye.";
        //enregistrons les informations dans le fichier xml
        if ($_POST['destination']=='Fichale KEZIRE' || $_POST['destination']=='Davina DAKO') {   
    $message=$xml->createElement("message",$_FILES["fichier"]["name"]);
    $message->setAttribute('type', $FileType);
    $emetteurs = "brahim";
    $emetteur=$xml->createElement("emetteur",$emetteurs);
    $recepteur=$xml->createElement("recepteur");
    $contact=$xml->createElement("contact");
    $contact_nomComplet=$xml->createElement("contact_nomComplet",$_POST['destination']);
    $groupe=$xml->createElement("groupe");
    //if($_POST['destination'] == 'M1-SRT' || $_POST['destination'] == 'M1-GLSI'){
    $nom_groupe=$xml->createElement("nom_groupe"); 
    $fichier_groupe=$xml->createElement("fichier_groupe");
    $type_fichier="";
    $fichier_groupe->setAttribute('type',$type_fichier);
//}
    $groupe->appendChild($nom_groupe);
    $groupe->appendChild($fichier_groupe);
    $contact->appendChild($contact_nomComplet);
    $recepteur->appendChild($contact);
    $recepteur->appendChild($groupe);
    $message->appendChild($emetteur);
    $message->appendChild($recepteur);
    $baliseRacine->appendChild($message);
    $xml->save("chat.xml");
    }
    // dans le cas ou le fichier doit etre envoyer a un groupe
    if ($_POST['destination']=='M1-SRT' || $_POST['destination']=='M1-GLSI') {
        
    $message=$xml->createElement("message",$_FILES["fichier"]["name"]);
    $message->setAttribute('type', $FileType);
    $emetteurs = "brahim";
    $emetteur=$xml->createElement("emetteur",$emetteurs);
    $recepteur=$xml->createElement("recepteur");
    $contact=$xml->createElement("contact");
    $contact_nomComplet=$xml->createElement("contact_nomComplet");
    $groupe=$xml->createElement("groupe");
    //if($_POST['destination'] == 'M1-SRT' || $_POST['destination'] == 'M1-GLSI'){
    $nom_groupe=$xml->createElement("nom_groupe",$_POST['destination']); 
    $fichier_groupe=$xml->createElement("fichier_groupe",$_FILES["fichier"]["name"]);
    $fichier_groupe->setAttribute('type',$FileType);
//}
    $groupe->appendChild($nom_groupe);
    $groupe->appendChild($fichier_groupe);
    $contact->appendChild($contact_nomComplet);
    $recepteur->appendChild($contact);
    $recepteur->appendChild($groupe);
    $message->appendChild($emetteur);
    $message->appendChild($recepteur);
    $baliseRacine->appendChild($message);
    $xml->save("chat.xml");
    }
    // dans le cas ou on envoie un fichier et un message
        
  } else {
    echo "desole une erreur est produite .";
  }
}
}
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Chat</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <center>
    <h5>Bienvenue dans notre plafeforme</h5>
    </center>
<div class="container">
  <div class="header">
    <h2>Destinataire</h2>
    <form action="index.php" method="POST" enctype="multipart/form-data">
    <select name="destination">
        <option value=""></option>
        <option value="Fichale KEZIRE">Fichale KEZIRE</option>
        <option value="Davina DAKO">Davina DAKO</option>
        <option value="M1-SRT">M1-SRT</option>
        <option value="M1-GLSI">M1-GLSI</option>
    </select>
  </div>
  <div class="chat-box">
    <div class="message-box left-img">
  <!--
      <div class="picture">
        <img src="" title="user name"/>
        <span class="time">temps</span>
      </div>
      <div class="message">
        <span>nom utilisateur</span>
        <p>message</p>
      </div>
    </div>
    <div class="message-box right-img">
      <div class="picture">
        <img src="" title="user name"/>
        <span class="time">temps</span>
      </div>
      <div class="message">
        <span>nom utilisateur</span>
        <p>message</p>
      </div>
    </div>
-->
    <div class="enter-message">
      <input type="text" name="message" placeholder="entrez votre message.."/>
      
      <input type="file" name="fichier" placeholder="Fichier/audio:" />
    </div>
      <input type="submit" name="Envoyer" value="Envoyer" class="send" />
  </div>
</div>
</form>
</body>
</html>
