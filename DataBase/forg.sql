DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `banned_users`;
DROP TABLE IF EXISTS `products`;
DROP TABLE IF EXISTS `produces`;
DROP TABLE IF EXISTS `shoping_lists`;
DROP TABLE IF EXISTS `statistics`;
DROP TABLE IF EXISTS `allergens`;



CREATE TABLE banned_users (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
 

CREATE TABLE users (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `isAdmin` int(1)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` float(50) NOT NULL,
  `season` varchar(100) NOT NULL,
  `category` varchar(200) NOT NULL,
  `diet` varchar(200) NOT NULL,
  `perishability` varchar(200) NOT NULL,
  `popularity` int(100) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `shoping_lists` (
    `user_id` int(11) NOT NULL,
    `product_id` int(11) NOT NULL,
    `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `allergens`(
    `name` varchar(200) NOT NULL,
    `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `isAdmin`) VALUES
(0, 'Alin', 'Joshu','seby_bik2e@yahoo.com',  '312B6DB61A37A2F1B126FA2C7976B613765EC577AE68577FE43771C12E1CA4549E376E04C91735AC446D664636AE5EE3150E9E076E649FAD18D0302BFBCF5669', 1),
(1, 'Georgescu', 'Andrew', 'galanandy4030@yahoo.ro', '92FC29510DFACE38FB0963D1CE2C6187C4B3B945E1CC9897CCD87697B19742D21582912581318B58B3DFBC44694FC8166C5FC79D85D85F72AFB4E7ED81218C21',0),
(2, 'Sebastian', 'Cotoc','seby_cotoc2398@yahoo.com', '92FC29510DFACE38FB0963D1CE2C6187C4B3B945E1CC9897CCD87697B19742D21582912581318B58B3DFBC44694FC8166C5FC79D85D85F72AFB4E7ED81218C21',  0);


INSERT INTO `products` (`id`, `name`, `price`, `season`, `category`, `diet`, `perishability`) VALUES
(1, 'apple', 4.50, 'fall', 'fruits_&_vegetables', 'vegan', 'very_perishable'),
(2, 'potato', 3.50, 'fall', 'fruits_&_vegetables', 'vegan', 'perishable'),
(3, 'whole_chicken', 7.50, 'all', 'meat', 'gluten-free', 'perishable'),
(4, 'butter', 4.55, 'all', 'dairy', 'gluten-free', 'hardly_perishable'),
(5, 'bread', 3, 'all', 'bakery', 'vegan', 'very_perishable'),
(6, 'chocolate', 6.5, 'all', 'dessert', 'none', 'perishable'),
(7, 'orange_juice', 7.5, 'all', 'drinks', 'vegan', 'perishable');

INSERT INTO `shoping_lists` (`user_id`, `product_id`, `quantity`) VALUES
(1,1,10),
(1,2,5),
(2,1,5),
(3,2,10),
(1,3,1);

INSERT INTO `allergens` ( `name`, `product_id`) VALUES
('poultry',3),
('lactose',4),
('gluten',5);


ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);


ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `banned_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

  ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

  ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;
  
  ALTER TABLE `banned_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;
COMMIT;

