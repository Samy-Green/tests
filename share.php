<?php
// share.php

// 1. Récupération des paramètres de l'URL
$network = isset($_GET['network']) ? strtolower($_GET['network']) : '';
$page_url = isset($_GET['url']) ? $_GET['url'] : '';

// Vérification de base des paramètres
if (empty($network) || empty($page_url)) {
    // Redirection simple si les paramètres sont manquants
    header('Location: index.html');
    exit();
}

// 2. Préparation des variables (utilisez des fonctions de sécurité si l'URL n'est pas déjà encodée ou si elle provient d'une source non fiable)
$encoded_url = urlencode($page_url);

// 3. Construction de l'URL de partage
$share_url = '';

switch ($network) {
    case 'facebook':
        // Partage Facebook (nécessite seulement l'URL)
        $share_url = "https://www.facebook.com/sharer/sharer.php?u={$encoded_url}";
        break;
    
    case 'twitter':
        // Partage Twitter (vous pouvez ajouter &text= pour pré-remplir le tweet, mais ici on se contente de l'URL)
        $share_url = "https://twitter.com/intent/tweet?url={$encoded_url}";
        break;
    
    case 'linkedin':
        // Partage LinkedIn (mini=true force la petite fenêtre de partage)
        $share_url = "https://www.linkedin.com/shareArticle?mini=true&url={$encoded_url}";
        break;
        
    default:
        // Si le réseau n'est pas reconnu, rediriger vers la page d'accueil ou afficher une erreur.
        header('Location: index.html');
        exit();
}

// 4. Redirection vers l'URL de partage
if (!empty($share_url)) {
    // La redirection HTTP (302 Found) ouvre la nouvelle page/fenêtre de partage
    header("Location: {$share_url}");
    exit();
}

?>