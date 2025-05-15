<?php
$question = 'Ile masz lat?';
$options  = [
    '<18' => '<18',
    '18-24'=> '18-24',
    '25-28'=> '25-28',
    '>28' => '>28',
];
$cookieName = 'sonda';
$cookieLifetime = 60*60;

$hasVoted = isset($_COOKIE[$cookieName]);
$userChoice = $hasVoted ? $_COOKIE[$cookieName] : null;

if (!$hasVoted && isset($_POST['vote'])) {
    $vote = $_POST['vote'];
    if (array_key_exists($vote, $options)) {
        setcookie($cookieName, $vote, time() + $cookieLifetime);
        $hasVoted = true;
        $userChoice = $vote;
    }
}

$votesFile = __DIR__.'/votes.json';
if (!file_exists($votesFile)) {
    file_put_contents($votesFile, json_encode(array_fill_keys(array_keys($options), 0)));
}
$votes = json_decode(file_get_contents($votesFile), true);

if ($hasVoted && isset($userChoice)) {
    if (isset($_POST['vote'])) {
        $votes[$userChoice]++;
        file_put_contents($votesFile, json_encode($votes));
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Sonda internetowa</title>
    <style>
        body { font-family: Arial, Helvetica, sans-serif; margin: 220px; }
        h1 { margin-bottom: 10px; }
        .results { margin-top: 15px; }
        .results div { margin: 3px 0; }
        .bar {
            display: inline-block;
            height: 10px;
            background: #4caf50;
            margin-left: 5px;
            vertical-align: middle;
        }
    </style>
</head>
<body>
<h1><?= $question ?></h1>

<?php if (!$hasVoted): ?>
    <form method="post">
        <?php foreach ($options as $key => $label): ?>
            <div>
                <label>
                    <input type="radio" name="vote" value="<?= $key ?>" required>
                    <?= $label ?>
                </label>
            </div>
        <?php endforeach; ?>
        <button type="submit">Głosuj</button>
    </form>
<?php else: ?>
    <p><b>Dziekujemy za zaglosowanie!</b></p>
    <p>Twoj glos: <em><?= isset($options[$userChoice]) ? $options[$userChoice] : "Nieznany" ?></em></p>
<?php endif; ?>
<div class="results">
    <h2>Wyniki:</h2>
    <?php
    $totalVotes = array_sum($votes);
    foreach ($votes as $key => $count):
        $percent = $totalVotes > 0 ? round(($count / $totalVotes) * 100) : 0;
        ?>
        <div>
            <?= htmlspecialchars($options[$key]) ?> (<?= $count ?>) – <?= $percent ?>%
            <span class="bar" style="width: <?= $percent ?>%;"></span>
        </div>
    <?php endforeach; ?>
</div>
</body>
</html>
