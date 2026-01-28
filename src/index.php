<?php 

$config = [
    'host'     => getenv('DB_HOST'),
    'user'     => getenv('DB_USER'),
    'pass'     => getenv('DB_PASS'),
    'database' => getenv('DB_DATABASE'),
    'driver'   => getenv('DB_DRIVER'),
];

$pdo = new PDO(
    $config['driver'] . ':host=' . $config['host'] . ';dbname=' . $config['database'],
    $config['user'],
    $config['pass'],
    [
        PDO::ATTR_EMULATE_PREPARES   => false,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]
);

$stmt = $pdo->query(
    'SELECT
        title, created_at, body
    FROM
        post
    ORDER BY
        created_at DESC'
);

if ($stmt === false)
{
    throw new Exception('There was a problem running this query');
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>A blog application</title>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    </head>
    <body>
        <h1>Blog title</h1>
        <p>This paragraph summarises what the blog is about.</p>
        <h2>Article 1 title</h2>
        <div>dd Mon YYYY</div>
        <p>A paragraph summarising article 1.</p>
        <p>
            <a href="#">Read more...</a>
        </p>
        <?php echo $stmt->fetch()['title'] ?>
        <h2>Article 2 title</h2>
        <div>dd Mon YYYY</div>
        <p>A paragraph summarising article 2.</p>
        <p>
            <a href="#">Read more...</a>
        </p>
    </body>
</html>