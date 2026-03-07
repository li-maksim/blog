<?php

// test user #1
$password = password_hash('1234', PASSWORD_DEFAULT);
$stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
$stmt->execute(['joe', 'joe@email.com', $password]);
$joeId = $pdo->lastInsertId();


// test user #2
$password = password_hash('qwerty', PASSWORD_DEFAULT);
$stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
$stmt->execute(['Phil', 'phil@email.com', $password]);
$PhilId = $pdo->lastInsertId();

// test post #1
$body = <<<BODY
Consumerism is a hallmark of our generation. We shop for therapy. We shop socially with friends. We buy in bulk. We buy for convenience. Heck, some of the best dates I’ve been on involved Target and a Pink Drink from Starbucks. While shopping can definitely be a convenience or a fun time, we are certainly paying the price. When asked “If you were to open a shop, what would you sell,” the, as my Mom would say, meat and potatoes of my answer lies in why I’m selling instead of what I’m selling. My shop would focus on helping others understand the quality of homemade goods, and highlight the feasibility of making their own goods. 

Here is a list of items I absolutely must have in my hypothetical shop:

    I began my journey of homemade goods with a pretty mainstream choice: soap. I couldn’t have a shop without my bars of soap. I imagine dye-free bars scented with essential oil, of course with the option of scent-free. My decision to exclude dyes is a financial one. I’ve never included dyes in my soap, because what on Earth is it for?? It’s just an extra ingredient to purchase. 
    The item I have been most surprised by in my homemaking journey is all-purpose cleaner. Honestly, I thought it would suck compared to store-bought. I was so pleasantly surprised by the quality and ease of making it. I would love to share this product with those who may need convincing as I once did. 

While I would likely have other items, these are my must-haves that I would really love to share with others. Somewhere in my shop or on my website, I would have links to my blog posts for information on how to make each item sold in the shop. My goal is always to help others save money in a world that makes it seemingly impossible. 
BODY;
$stmt = $pdo->prepare("INSERT INTO posts (author_id, title, body) VALUES (?, ?, ?)");
$stmt->execute([$joeId, 'My Homemade Goods', $body]);
$firstPostId = $pdo->lastInsertId();

// test post #2
$body = <<<BODY
Useful skills our ancestors used are becoming lost in time. With busy lives full of automation and technology, we have forgotten the benefits of these skills. One skill that may spark memories of your grandmother is sewing. Picking up the skill of sewing will be good for your mind and your budget. 

Mend Damaged Clothes

Clothes are expensive. Even Walmart has increased the price of their clothing lines. If you get an itch to turnover your closet for something different, you’ll be spending a significant amount of money unnecessarily. Cheaper options, like Walmart or Plato’s Closet, have nothing on upcycling the clothing you already have. Embroidery is in right now. Learn to embroider simple flowers, your name, a catchy phrase, or line your pockets with a cute pattern. Here is an embroidery video on YouTube that is perfect for beginners. With practice you can move on to embroider more complex designs like mountains, people, or animals.

With free classes and YouTube videos, all you will need to purchase is string, a needle, and an embroidery hoop. Purchasing these supplies through your local Walmart come out to about $4 depending on how many colors of thread you want. Now imagine you went to a boutique to buy that $40 top you’ve had on your mind, or even Walmart for a $15 top.

Are you lacking in creative skills? I empathize with you, truly. A great tool where others share inspiration for free is TikTok. While TikTok isn’t normally a great way to spend your precious time, it is a great way to learn from the creative community. So, get on there and search up some cute embroidery ideas. Or if you’re just wanting to be a hobbyist and have little creative skill, you can purchase embroidery kits like this floral butterfly design. I just hope you can count better than I can! :)
BODY;
$stmt = $pdo->prepare("INSERT INTO posts (author_id, title, body) VALUES (?, ?, ?)");
$stmt->execute([$PhilId, 'Learning to Sew is Good for the Budget and the Mind', $body]);

// test comment
$stmt = $pdo->prepare("INSERT INTO comments (post_id, author_id, body) VALUES (?, ?, ?)");
$stmt->execute([$firstPostId, $PhilId, 'Great post, joe!']);