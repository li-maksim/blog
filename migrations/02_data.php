<?php

// admin
$password = password_hash('admin', PASSWORD_DEFAULT);
$stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
$stmt->execute(['admin', 'admin@email.com', $password]);

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

// test post #3
$body = <<<BODY
As we head into the weekend, cleaning is likely the *least* exciting thing you have planned for a couple of days off. At least for me it is. But, that’s not to say there aren’t jobs that just have to get done to make sure we can have fun AT the zoo, instead of having our home look and smell like one. 

If you know me, you know I hate to clean, so I do everything I can to ensure I’m using cleaning products, tools, and techniques that help me clean smarter and faster – not harder. This is why I’ve compiled a list of 7 innovative tools to help you get the work done. Isn’t it great when you don’t have to give cleaning 100% of your energy? 

I’m always looking online to see what the latest buzzy cleaning tools and products are all about. Are they worth the hype or just a big waste? I’ve tested some products that I think are definitely worth the hype, so I’m going to share them with you to save you some precious time and energy this weekend.
BODY;
$stmt = $pdo->prepare("INSERT INTO posts (author_id, title, body) VALUES (?, ?, ?)");
$stmt->execute([$PhilId, '7 Clever Cleaning Tools', $body]);

// test post #4
$body = <<<BODY
Washing the outside of your car is easy. You grab some soap and water, or better yet, you drive through a car wash and forget about it. But car interior cleaning is a much bigger job. We all eat in our cars, our kids eat in our cars, our pets get hair all over the seats. Basically, our cars can turn into a hazard zone pretty quickly. 

That’s why I decided to share my tips on how to clean a car interior. Today we’re going to cover a list of the most common areas you should be cleaning in your car: 

    Clean your car’s floor mats
    How to clean car carpets
    How to clean inside car windows
    How to clean car seats 
    Cleaning car consoles and doors
    Eliminating car odors

A few years ago, I wrote an article outlining my favorite car cleaning tips and secrets. Now, I’m getting into the dirty details of what to clean in your car and how, plus some DIY cleaning solution recipes. So buckle up for my best car cleaning secrets and get to work on those fast-food wrappers and dust mites that have made your car their home. 
BODY;
$stmt = $pdo->prepare("INSERT INTO posts (author_id, title, body) VALUES (?, ?, ?)");
$stmt->execute([$PhilId, 'Car Interior Cleaning', $body]);

// test post #5
$body = <<<BODY
Folks who own an oven (i.e., everyone) should be cleaning it. But how often should you clean your oven? And how do you clean an oven anyway? Surprisingly, I don’t have any articles on this yet… until now. 

If you have a self-cleaning oven, stop right there. Do not follow this guide. Instead, read How To Clean A Self-Cleaning Oven: 7 Kitchen Cleaning Tips. But if you don’t have a self-cleaning oven, this article will guide you through how to clean an oven and get it spic and span in no time. OK, not like actually no time, but in as little time as possible.

And not only am I going to tell you how to clean an oven, but I’m going to share the best oven cleaner out there. Hint: it’s DIY! So oven crud beware, you’re getting cleaned. 

How Often Should You Clean Your Oven?

Cleaning your oven is really a choose-your-own-adventure-type cleaning task because you can dial it up or dial it down as much as you want. And no, I don’t mean your oven dial. I mean, you can put a lot of effort in and go full force, or you can just kind of… squeak by. But the more thorough you are when you clean the oven, the longer you can wait before you have to do it again. 

So how often should you clean your oven? Cleaning the oven should happen on a fairly regular basis. I can’t say exactly how often; it depends on how frequently you cook and how frequently you spill. 

Deciding when you clean your oven really depends on what the interior looks like. Do a visual inspection to decide if it’s that time. When you notice spills and gunk in your oven, it’s probably time to clean. This foodstuff will bake and bake and bake onto your oven, and eventually cause bad smells and smoke, and can even leave your food tasting a little weird. So clean before this happens. 
Oven Cleaning Products and Tools

Before you get to cleaning, let’s talk about what products and tools you’ll need. To clean your oven from top to bottom, you need: 

    White vinegar
    Dish soap
    Baking soda
    Bar Keepers Friend
    Paper towel
    Microfiber cloths
    Cleaning scraper (or windshield scraper or old credit card) 
    Scotch-Brite Heavy Duty Scour Pad
    Old sponge
    Newspaper
    Handheld vacuum (or vacuum with a long attachment)

Yep, that’s it! I only use very simple cleaning products and tools to clean the oven. Oven cleaning doesn’t have to be complicated or harsh. You just have to know what you’re doing and have a good plan of attack. And with these simple products, you can make your own DIY oven cleaner. 
BODY;
$stmt = $pdo->prepare("INSERT INTO posts (author_id, title, body) VALUES (?, ?, ?)");
$stmt->execute([$PhilId, 'How To Clean an Oven', $body]);

// test post #6
$body = <<<BODY
As a cleaning expert, I am pleased to be able to share crucial information about cleaning and disinfecting at home when illness is a concern. I’m going to explain the what, how, when, where, and why, when it comes to disinfecting. I will also share some other important (and often not talked about) information that you need to know about keeping your family and your home healthy. The information I am sharing comes from trusted sources, and from 13+ years of experience as a cleaning professional.

I strongly encourage you to check with the authorities on this topic—the CDC, the WHO, and your government’s national health agency are the places to start. I am using information that is most up-to-date based on what we know about COVID-19, and am using that as a benchmark for this article. Also, this is a long article, but, this isn’t the time to skimp on information. I think the more I can share, the more details you know, hence the better equipped we’ll all be.
Cleaning, Sanitizing & Disinfecting

These words get used interchangeably—they shouldn’t be! In order for you to understand the information you are reading, and to speak correctly about what is being done, I’m going to define them for you here in layman’s terms. Let’s think about these things like a traffic light system.
Cleaning 

This would be green. It is essentially caring for surfaces with the appropriate product and tool. When we clean, we want to remove dust, dirt, and debris from a surface to make it look presentable. Generally, when I clean I like to use an all-purpose cleaner—I use my DIY version most often because it’s easy to make and costs pennies. Soap and water kills a certain amount of bacteria on a surface and is fine for everyday use. The focus of cleaning isn’t necessarily to kill bacteria (although it will happen to some extent), but rather to maintain a surface.
Sanitizing

This would be yellow. It reduces—but doesn’t necessarily eliminate—microorganisms from a surface to levels considered safe as determined by public health codes and regulations. When we sanitize, we are getting rid of the bad stuff without obliterating every organism on a surface. It’s more intense than a regular cleaning you’d perform at home since public safety is often at stake. At home, I don’t think about sanitizing. For me, I’m either cleaning or disinfecting (although, if my dishwasher or washing machine has a sanitize cycle, I’ll use it when needed).
Disinfecting 

This would be red. It’s the type of cleaning performed to destroy and/or prevent the growth of disease-causing microorganisms. A disinfectant is an agent such as heat or chemicals that disinfects by destroying, neutralizing, and/or inhibiting the growth of disease-carrying microorganisms. There are 2 types of disinfectants: hospital-grade and general disinfectants.
BODY;
$stmt = $pdo->prepare("INSERT INTO posts (author_id, title, body) VALUES (?, ?, ?)");
$stmt->execute([$PhilId, 'How to Disinfect Your Home', $body]);

// test post #7
$body = <<<BODY
t is staggering how much food we waste. A recent study showed that Americans waste approximately 25% of all food that they purchase. That’s essentially taking every fourth grocery bag and tossing it in the garbage on the way after shopping. When we think about food waste a lot of it comes down to simply using it. But, it also comes down to proper food storage—because the better you know how to store your food, the longer it will last, meaning less waste.

Berries

Berries go bad pretty quickly. They’re also expensive, and when they’re in abundance you want to eat ALL the berries, but how do you preserve them? A great way to save your berries is to freeze them. But here’s the thing—you can’t just wash them and dump them into a freezer bag with the hope of using/eating them a few at a time. What inevitably happens is they all clump together and then you get this big frozen mass of berries. Instead, clean your berries, chop them into your desired size, and then find yourself a cookie sheet. Lay the berries out flat as if you were roasting veggies, then put that in the freezer. Let the berries freeze completely then take them off the tray and pop them into a storage container and put that in the freezer. Boom! Nice frozen individual berries.
Sugar

If you store sugar at home, you’ve probably encountered the rock-hard mass that develops over time. In order to keep sugar in its crystal format what you need to do is find a nice airtight container, something that ideally has a tight-fitting lid with a rubber seal on it. You can get these at tons of stores, they’re not expensive and they really do preserve the life of your sugar, whether white or brown. The other thing that’s great about this is it keeps pests (think ants/mice etc.) out and as we all know that these little critters love sugar!

Lettuce

There are lots of varieties of lettuce. I’m going to specifically focus on head lettuce. That’s anything that’s attached by a core at the bottom—romaine, iceberg, you get the picture. When you bring that home this instinct is to cut it all up, rinse and store it, but that is actually not the right thing to do! This actually ages head lettuce quicker. Head lettuce wants to be kept intact for as long as possible. So when you get it home, you want to have a look at the lettuce, remove anything that’s wilted or moldy or kind of decaying. Then, you want to wrap the lettuce in a paper towel and put it into a crisper drawer. Now, I always like to keep my crisper drawers lined with paper towel which also helps. The other thing to remember is to keep your lettuce away from anything that is a ripener—something that produces ethylene gas, so apples, pears, avocados, just to name a few. Meaning, if you’re going to store your lettuce in one drawer, you want to store that stuff somewhere else.
Kale & Spinach

On the topic of leafy things, we’ve got some other super-greens that we have to cover off, namely kale and spinach. These are clearly not attached to a head like the lettuce that we just talked about. Now, particularly with spinach, it tends to get slimy really quickly and in turn can go bad quickly as well. So, as soon as you get this stuff home, don’t just put it in the fridge, there’s a little bit of prep involved if you want this stuff to last. What you want to do is pick through all the pieces and pull out anything that is slimy, wilted, or looks like it’s on the brink of going bad. Toss that. Then, you want to throw your greens into a salad spinner. You’re going to rinse really, really, really well. Then spin like crazy. Once they’re dry, you’re going to put them into a zipper-lock bag (or a glass container) lined with paper towel and store that in your fridge. This can keep your greens in really good shape for up to a couple of weeks.
BODY;
$stmt = $pdo->prepare("INSERT INTO posts (author_id, title, body) VALUES (?, ?, ?)");
$stmt->execute([$PhilId, 'Foods You Storing All Wrong', $body]);

// test comment
$stmt = $pdo->prepare("INSERT INTO comments (post_id, author_id, body) VALUES (?, ?, ?)");
$stmt->execute([$firstPostId, $PhilId, 'Great post, joe!']);