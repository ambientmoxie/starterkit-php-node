<?php require_once __DIR__ . '/assets/helpers/index.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banner Preview Page</title>
    <?php if (viteEnv('VITE_DEV') === "true"): ?>
        <!-- Include Vite dev server for HMR -->
        <script type="module" src="http://<?= viteEnv('VITE_DEV_SERVER_IP') ?>:3000/@vite/client"></script>
        <script type="module" src="http://<?= viteEnv('VITE_DEV_SERVER_IP') ?>:3000/assets/js/main.js" defer></script>
    <?php else: ?>
        <!-- Include the production build files -->
        <link rel="stylesheet" href="<?= hashedAssetURL("css") ?>">
        <script src="<?= hashedAssetURL("js") ?>" type="module" defer></script>
    <?php endif; ?>
</head>

<body>
    <?php echo viteEnv('VITE_DEV'); ?>
</body>

</html>