-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2023 at 09:36 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `news`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image` blob DEFAULT NULL,
  `content` text DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `categoryid` int(11) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `title`, `image`, `content`, `userid`, `categoryid`, `timestamp`) VALUES
(14, 'World Leaders Gather for Global Summit on Climate Change', 0x55706c6f6164732f53637265656e73686f7420323032332d30372d3032203137353632342e706e67, 'World leaders from across the globe convened today for a historic summit on climate change. The event aimed to address the pressing issue of global warming and its devastating effects on the environment. With rising sea levels, extreme weather events, and biodiversity loss threatening our planet, the summit served as a platform for countries to commit to ambitious targets and sustainable solutions. Discussions centered around renewable energy, emissions reduction, and international cooperation. The summit concluded with a joint declaration, signaling a united front in the fight against climate change.', 2, 1, '2023-07-02 23:24:03'),
(15, 'Government Announces New Tax Reform Plan to Boost Economy', 0x55706c6f6164732f53637265656e73686f7420323032332d30372d3032203137353934392e706e67, 'In an effort to stimulate economic growth, the government unveiled an ambitious tax reform plan today. The plan aims to provide relief to both businesses and individuals, with significant reductions in corporate taxes and income tax rates. The government believes that these measures will encourage investment, spur job creation, and ultimately strengthen the economy. However, the proposed reforms have faced criticism from some quarters, who argue that they may exacerbate income inequality. The plan will now undergo a legislative process to determine its implementation.', 2, 1, '2023-07-02 23:24:31'),
(16, 'Controversial Immigration Bill Passes Senate, Faces Opposition', 0x55706c6f6164732f53637265656e73686f7420323032332d30372d3032203138303433302e706e67, 'After months of heated debate, a controversial immigration bill successfully passed the Senate today. The bill proposes significant changes to the country\'s immigration policies, including stricter border controls and a revised pathway to citizenship. Proponents argue that the bill will enhance national security and ensure a fair and orderly immigration system. However, critics have voiced concerns over potential discrimination and human rights violations. As the bill advances to the next stage of the legislative process, it is expected to face strong opposition and further amendments.', 2, 1, '2023-07-02 23:24:49'),
(17, 'Prime Minister Visits Neighboring Country to Strengthen Diplomatic Ties', 0x55706c6f6164732f53637265656e73686f7420323032332d30372d3032203138303532312e706e67, 'In a diplomatic mission aimed at enhancing bilateral relations, the Prime Minister embarked on a state visit to a neighboring country today. The visit signifies a renewed commitment to cooperation, mutual understanding, and regional stability. During the trip, the Prime Minister engaged in high-level meetings with government officials, signed strategic agreements, and explored avenues for economic collaboration. The visit is expected to foster closer ties between the two nations and pave the way for future partnerships in various sectors.', 2, 1, '2023-07-02 23:25:02'),
(18, 'Political Scandal Erupts as High-ranking Official Faces Corruption Charges', 0x55706c6f6164732f53637265656e73686f7420323032332d30372d3032203138303730332e706e67, 'A political scandal erupted today as a high-ranking government official was charged with corruption. The official, who held a prominent position in the administration, is accused of embezzlement, bribery, and abuse of power. The charges have sent shockwaves through the political landscape, raising questions about accountability and transparency. Investigations are underway, and the judicial system will determine the official\'s guilt or innocence. The scandal has ignited public outcry and demands for stricter anti-corruption measures within the government.', 2, 1, '2023-07-02 23:25:25'),
(19, 'Record-Breaking Performance: Athlete Sets New Olympic World Record', 0x55706c6f6164732f53637265656e73686f7420323032332d30372d3032203138323235322e706e67, 'In a jaw-dropping display of athleticism, an accomplished athlete shattered a long-standing Olympic record today. The remarkable achievement took place in the highly anticipated event, leaving spectators in awe of the athlete\'s exceptional skill and dedication. The new record marks a significant milestone in the sport\'s history and cements the athlete\'s place among the all-time greats. As the news spreads, the world celebrates this extraordinary feat and eagerly anticipates future performances from this exceptional talent.', 5, 2, '2023-07-02 23:27:26'),
(20, 'Local Soccer Team Wins Championship in Dramatic Overtime Victory', 0x55706c6f6164732f53637265656e73686f7420323032332d30372d3032203138323334342e706e67, 'In a thrilling finale that kept fans on the edge of their seats, the local soccer team emerged victorious in the championship match, securing the coveted title. The closely contested game went into overtime, with both teams displaying incredible determination and skill. In a dramatic turn of events, the winning goal was scored in the final minutesof extra time, sending the crowd into a frenzy of excitement. The victory is a testament to the team\'s hard work, strategic gameplay, and unwavering teamwork throughout the season. As celebrations erupt across the city, fans unite in their support, eagerly awaiting the team\'s future endeavors and the opportunity to defend their championship title.', 5, 2, '2023-07-02 23:27:40'),
(21, 'Star Quarterback Sidelined with Season-Ending Injury', 0x55706c6f6164732f53637265656e73686f7420323032332d30372d3032203138313634332e706e67, 'In a devastating blow to the team and fans alike, the star quarterback suffered a season-ending injury during a recent game. The quarterback, known for their exceptional talent and leadership on the field, was a driving force behind the team\'s success. The injury not only impacts the team\'s performance but also leaves a void in the hearts of supporters who have rallied behind the quarterback throughout their career. As the team regroups and adjusts their strategies, fans send messages of support and hope for a speedy recovery for their beloved athlete.\r\n', 5, 2, '2023-07-02 23:27:54'),
(22, 'World Cup Bid Announced: Country Aims to Host Prestigious Soccer Tournament', 0x55706c6f6164732f53637265656e73686f7420323032332d30372d3032203138313730342e706e67, 'Excitement is building as Country announces its bid to host the upcoming World Cup, one of the most prestigious soccer tournaments in the world. With state-of-the-art stadiums, a rich soccer culture, and a passionate fan base, the country believes it is well-equipped to provide an unforgettable experience for players and fans alike. Hosting the World Cup would not only boost the country\'s international profile but also generate significant economic benefits and leave a lasting legacy for the sport. The bidding process is expected to be highly competitive, and the country eagerly awaits the final decision.', 5, 2, '2023-07-02 23:28:08'),
(23, 'Basketball Superstar Signs Lucrative Contract Extension with Current Team', 0x55706c6f6164732f53637265656e73686f7420323032332d30372d3032203138313830312e706e67, 'In a much-anticipated move, a basketball superstar has agreed to a contract extension with their current team, solidifying their commitment and loyalty to the franchise. The lucrative deal reflects the player\'s exceptional talent, leadership, and contributions to the team\'s success. The extension not only ensures the superstar\'s presence on the court for the foreseeable future but also provides stability and confidence to the team and its fans. With the player\'s continued presence, the team aims to build on their achievements and compete for championships, sparking renewed excitement among supporters.\r\n', 5, 2, '2023-07-02 23:28:21'),
(24, 'Critically Acclaimed Film Sweeps Awards Season, Wins Best Picture\"', 0x55706c6f6164732f53637265656e73686f7420323032332d30372d3032203138323831362e706e67, 'In a remarkable feat, a critically acclaimed film has taken the entertainment industry by storm, winning the prestigious Best Picture award at multiple award ceremonies. The thought-provoking storyline, stellar performances, and exceptional filmmaking have captivated audiences and critics alike. The film\'s success not only celebrates the art of cinema but also sheds light on important social issues, leaving a lasting impact on viewers. As the awards season comes to a close, the film\'s triumph serves as an inspiration to aspiring filmmakers and a testament to the power of storytelling.', 6, 3, '2023-07-02 23:32:33'),
(25, 'Pop Icon Announces Comeback Tour after 5-Year Hiatus', 0x55706c6f6164732f53637265656e73686f7420323032332d30372d3032203138323835322e706e67, 'Fans around the world are ecstatic as a beloved pop icon announces their highly anticipated comeback tour after a 5-year hiatus. The iconic performer, known for their electrifying stage presence and chart-topping hits, has been sorely missed by their dedicated fanbase. The comeback tour promises to be a spectacle of music, dance, and mesmerizing performances, showcasing the artist\'s evolution and growth during their time away from the spotlight. Ticket sales are expected to soar as fans eagerly secure their spots to witness this momentous return to the stage.', 6, 3, '2023-07-02 23:32:57'),
(26, 'Blockbuster Movie Franchise Announces Spin-off Series for Streaming Platform', 0x55706c6f6164732f53637265656e73686f7420323032332d30372d3032203138323934372e706e67, 'Fans of a popular blockbuster movie franchise have reason to celebrate as the studio announces a spin-off series exclusively for a major streaming platform. Building on the rich and expansive universe of the original films, the spin-off promises to delve deeper into captivating storylines, explore new characters, and provide an immersive viewing experience for fans.\r\n\r\nViewers can expect the same high production value, gripping plotlines, and thrilling action that made the movie franchise a global phenomenon. With the convenience of streaming, fans will have the opportunity to dive further into the franchise\'s universe and connect with their favorite characters on a whole new level. Anticipation is at an all-time high as fans eagerly await the series premiere and prepare for an exciting new chapter in their beloved franchise.', 6, 3, '2023-07-02 23:33:22'),
(27, 'Celebrity Couple Confirms Engagement with Romantic Beachside Proposal', 0x55706c6f6164732f53637265656e73686f7420323032332d30372d3032203138333034302e706e67, 'Love is in the air as a well-known celebrity couple confirms their engagement following a breathtaking beachside proposal. The romantic gesture took place against a picturesque backdrop, with the sun setting on the horizon as the couple exchanged heartfelt vows. The news of their engagement has set social media abuzz, with fans and well-wishers flooding the internet with messages of congratulations and support. As the couple begins their journey towards a lifetime of happiness together, fans eagerly await updates on wedding plans and future milestones.', 6, 3, '2023-07-02 23:33:39'),
(28, 'Chart-Topping Band to Headline Music Festival, Promises Unforgettable Performance', 0x55706c6f6164732f53637265656e73686f7420323032332d30372d3032203138333133322e706e67, 'Music enthusiasts are in for a treat as a chart-topping band is announced as the headline act for a highly anticipated music festival. Known for their energetic live performances, infectious melodies, and charismatic stage presence, the band is set to deliver an unforgettable show. Fans can expect a dynamic setlist featuring their greatest hits and new material, accompanied by mesmerizing visuals and show-stopping choreography. With the band\'s reputation for creating an electric atmosphere, the festival is expected to draw crowds from far and wide, eager to witness this extraordinary musical experience.', 6, 3, '2023-07-02 23:33:55'),
(29, 'Tech Giant Unveils Groundbreaking Artificial Intelligence Breakthrough', 0x55706c6f6164732f53637265656e73686f7420323032332d30372d3032203138333230382e706e67, 'In a major technological breakthrough, a leading tech giant has unveiled a groundbreaking advancement in artificial intelligence (AI). The new AI system demonstrates remarkable capabilities, such as enhanced natural language processing, advanced image recognition, and unprecedented problem-solving abilities. This development holds the potential to revolutionize various industries, from healthcare and finance to transportation and customer service. Experts hail this achievement as a significant step forward in the field of AI, opening up endless possibilities for innovation and improving the way we interact with technology.\r\n', 12, 4, '2023-07-02 23:35:32'),
(30, 'New Smartphone Model Released with Advanced Features and Enhanced Security', 0x55706c6f6164732f53637265656e73686f7420323032332d30372d3032203138333233392e706e67, 'Tech enthusiasts rejoice as a highly anticipated smartphone model hits the market, offering cutting-edge features and enhanced security measures. The new device boasts an array of innovative technologies, including a powerful processor, a high-resolution display, and an upgraded camera system. Additionally, stringent security measures, such as facial recognition and encrypted data storage, provide users with peace of mind in an increasingly interconnected world. With its sleek design and state-of-the-art features, the smartphone aims to set a new standard for mobile devices and satisfy the demands of even the most discerning users.', 12, 4, '2023-07-02 23:35:47'),
(31, 'Scientists Develop Revolutionary Battery Technology for Electric Vehicles', 0x55706c6f6164732f53637265656e73686f7420323032332d30372d3032203138333331312e706e67, 'In a significant breakthrough for the electric vehicle (EV) industry, scientists have developed a revolutionary battery technology that promises to overcome current limitations and accelerate the adoption of EVs. The new battery design offers improved energy density, faster charging capabilities, and longer lifespan, addressing critical concerns regarding range anxiety and charging infrastructure. This development holds the potential to make EVs more accessible and practical for consumers, paving the way for a sustainable transportation revolution. With continued research and development, experts anticipate a future where EVs dominate the automotive landscape.\r\n', 12, 4, '2023-07-02 23:36:03'),
(32, 'Startup Launches Innovative App to Streamline Home Automation', 0x55706c6f6164732f53637265656e73686f7420323032332d30372d3032203138333334362e706e67, 'A promising startup has launched an innovative app that aims to streamline home automation and provide users with seamless control over their smart devices. The app offers a unified platform where users can effortlessly manage their interconnected devices, including smart lighting, thermostats, security systems, and entertainment systems. By simplifying the user experience and enhancing interoperability, the app seeks to remove barriers to adoption and accelerate the integration of smart technology into everyday homes. With intuitive controls, personalized settings, and compatibility with popular smart home devices, the app empowers users to create a truly connected and intelligent living environment. This startup\'s vision for the future of home automation is receiving positive feedback from early adopters and industry experts, paving the way for a more convenient and efficient lifestyle.', 12, 4, '2023-07-02 23:36:17'),
(33, 'Tech Company Launches Cutting-Edge Virtual Reality Gaming System', 0x55706c6f6164732f53637265656e73686f7420323032332d30372d3032203138333431392e706e67, 'Get ready to immerse yourself in a whole new world of gaming as a tech company launches its highly anticipated virtual reality (VR) gaming system. The state-of-the-art VR headset, coupled with intuitive motion controllers and a vast library of immersive games, offers players a truly captivating gaming experience. From exploring fantastical realms to engaging in adrenaline-pumping adventures, the system transports players into a virtual realm where the boundaries of reality are blurred. With its advanced graphics, responsive gameplay, and realistic simulations, the VR gaming system is set to revolutionize the way we play and redefine the future of interactive entertainment.', 12, 4, '2023-07-02 23:36:34'),
(34, 'Global Company Reports Record Profits in Latest Financial Quarter', 0x55706c6f6164732f53637265656e73686f7420323032332d30372d3032203137333432352e706e67, 'A global company has announced its highest-ever profits in the latest financial quarter, surpassing market expectations and solidifying its position as an industry leader. The exceptional performance can be attributed to robust sales across multiple product lines, successful cost management strategies, and expansion into emerging markets. With a strong financial foundation, the company is well-positioned to invest in future growth opportunities and continue delivering value to its shareholders. The positive results have garnered praise from investors and industry analysts, generating optimism about the company\'s long-term prospects.', 1, 5, '2023-07-02 23:38:54'),
(35, 'E-commerce Giant Launches Ambitious Sustainability Initiative', 0x55706c6f6164732f53637265656e73686f7420323032332d30372d3032203137333333312e706e67, 'In a bid to address environmental concerns and reduce its carbon footprint, a prominent e-commerce giant has launched an ambitious sustainability initiative. The company aims to implement eco-friendly practices throughout its operations, including optimizing packaging, transitioning to renewable energy sources, and promoting responsible supply chain management. By prioritizing sustainability, the e-commerce giant aims to set a positive example for the industry and contribute to global efforts in mitigating climate change. This initiative reflects a growing awareness of the importance of corporate responsibility and resonates with environmentally conscious consumers.', 1, 5, '2023-07-02 23:39:11'),
(36, 'Startup Secures Multi-Million Dollar Investment to Fuel Expansion', 0x55706c6f6164732f53637265656e73686f7420323032332d30372d3032203137333233342e706e67, 'A promising startup has successfully secured a multi-million dollar investment from venture capitalists, providing a significant boost to its expansion plans. The funding will be utilized to scale operations, enhance product development, and expand market reach. With the financial backing and support of experienced investors, the startup aims to solidify its position in the market and capitalize on emerging opportunities. This investment not only validates the startup\'s potential but also signifies the confidence of industry experts in its business model and growth prospects.\r\n', 1, 5, '2023-07-02 23:39:28'),
(37, 'Retail Chain Implements Innovative Technology to Enhance Customer Experience', 0x55706c6f6164732f53637265656e73686f7420323032332d30372d3032203137333133392e706e67, 'A well-known retail chain is revolutionizing the shopping experience by implementing innovative technology solutions. Through the integration of augmented reality (AR), interactive displays, and personalized recommendations, the chain aims to create a seamless and immersive shopping environment. Customers can visualize products in real-time, receive tailored suggestions based on their preferences, and enjoy a more engaging and convenient shopping journey. By leveraging technology, the retail chain seeks to stay ahead of evolving consumer expectations and foster deeper connections with its customer base.', 1, 5, '2023-07-02 23:39:43'),
(38, 'Financial Institution Launches Digital Banking Platform for Enhanced Convenience', 0x55706c6f6164732f53637265656e73686f7420323032332d30372d3032203137333034352e706e67, 'A leading financial institution has unveiled its cutting-edge digital banking platform, designed to provide customers with enhanced convenience and flexibility in managing their finances. The platform offers a range of features, including mobile banking, contactless payments, and intuitive financial planning tools. Customers can now perform transactions, access account information, and track expenses anytime, anywhere, with just a few taps on their smartphones. The launch of this digital banking platform represents the institution\'s commitment to leveraging technology to meet the evolving needs and preferences of its customers in an increasingly digital era. By prioritizing user-friendly interfaces, robust security measures, and personalized financial insights, the institution aims to deliver a seamless and empowering banking experience to its customer base.', 1, 5, '2023-07-02 23:40:00');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryid` int(11) NOT NULL,
  `categorytype` varchar(255) DEFAULT NULL,
  `categorydesc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryid`, `categorytype`, `categorydesc`) VALUES
(1, 'Politics', 'News related to politics'),
(2, 'Sports', 'News related to sports'),
(3, 'Entertainment', 'News related to entertainment'),
(4, 'Technology', 'News related to technology'),
(5, 'Business', 'News related to business'),
(6, 'Trending', 'Things that are trending in social media right now');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int(11) NOT NULL,
  `userpass` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `background` text DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `authority` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `userpass`, `name`, `background`, `username`, `authority`, `email`) VALUES
(1, '$2y$10$h/NsktH./d1VeY3Wn7sB5.EgzbLz3ve4rw2UvjJi32KK84HnpTAH6', 'Tiffanny Mid', 'Tiffany Mid, an esteemed journalist and business expert, holds the distinguished role of Editor-in-Chief at a prominent news company. With her wealth of knowledge in business strategy, finance, and entrepreneurship, Tiffany brings a unique perspective to her leadership position. As the Editor-in-Chief, she oversees the entire media team and plays a pivotal role in shaping the editorial direction of the news organization.\r\n\r\nTiffany\'s extensive experience in journalism and her deep understanding of the business landscape make her an ideal candidate for this leadership role. She leverages her expertise to guide the editorial team, ensuring the delivery of high-quality and impactful news content to the readers. With a keen eye for stories that matter, Tiffany assigns and reviews articles, providing valuable guidance and feedback to journalists under her supervision.\r\n\r\nAs an advocate for journalistic integrity and ethical reporting, Tiffany sets high standards for the news organization. She emphasizes the importance of accuracy, unbiased reporting, and adherence to journalistic ethics in every aspect of the team\'s work. Her dedication to delivering credible and trustworthy news is reflected in the news company\'s reputation for excellence and reliability.\r\n\r\nBeyond her editorial responsibilities, Tiffany also plays a key role in collaborating with other departments within the news organization. She works closely with the production team to ensure seamless content creation and publication processes. Additionally, she collaborates with the marketing and business development teams to enhance the news company\'s reach, impact, and financial sustainability.\r\n\r\nTiffany\'s leadership as the Editor-in-Chief not only shapes the news organization\'s editorial direction but also inspires and mentors aspiring journalists within the media team. Through her guidance, she fosters a culture of continuous learning and professional growth, empowering her team members to excel in their roles and make meaningful contributions to the field of journalism.\r\n\r\nWith Tiffany Mid at the helm, the media team thrives under her visionary leadership, producing influential and insightful news content that captivates audiences and drives meaningful conversations in the business world. Her dedication to journalistic excellence and her commitment to empowering her team make her a respected leader in the industry.\r\n\r\n', 'tiffany', 'admin', 'mhafiedzhelmi@gmail.com'),
(2, '$2y$10$qlaCIZPatXX1EFSvz65EAetLBkVxWK9AAW7KTTXUK.2lwPlVfPzCe', 'Maria Chin', 'Maria Chin is an esteemed journalist known for her investigative reporting and fearless pursuit of the truth. Born into a family of activists, Maria developed a deep passion for social justice from a young age. She began her career as a local news reporter, covering stories that shed light on corruption, human rights violations, and political unrest. Her relentless dedication to uncovering the truth earned her numerous accolades and a reputation for being a voice for the voiceless. Maria\'s work has led to significant reforms, exposing wrongdoing and holding those in power accountable. With her unwavering commitment to journalism, Maria continues to inspire the next generation of reporters and advocates for a more just and transparent society.', 'maria', 'staff', '2021619552@STUDENT.UITM.EDU.MY'),
(5, '$2y$10$luo.xUv45CejfiD2gRLHR.mfYUfQKSUKbr6jAM1f.dXCtMpZ0si0m', 'Hakiem Roslan', 'Hakiem Roslan is a renowned sports journalist known for his captivating storytelling and insightful analysis. With a keen eye for detail and an encyclopedic knowledge of sports, Hakiem has become a trusted voice in the world of sports journalism. His love for sports began in his childhood, where he would spend countless hours watching games and analyzing strategies. Hakiem\'s engaging writing style and ability to capture the emotions and narratives behind each athletic endeavor have earned him a dedicated following. Whether he\'s covering major tournaments, interviewing sports icons, or offering in-depth analysis, Hakiem\'s passion for sports shines through, making him a respected authority in the field.', 'hakiem', 'staff', '2021619682@student.uitm.edu.my'),
(6, '$2y$10$CO/DeGq86Wa/iPtcBY/e1Ow4Up1tzY81ujUxQR1H6jVY3piQuzDuW', 'Emma Wood', 'Emma Wood is a versatile entertainment journalist with a knack for uncovering the latest trends and stories in the world of entertainment. From red carpet events to exclusive interviews, Emma has established herself as a go-to source for the latest celebrity news and insights. With her witty writing style and engaging personality, she brings a fresh and unique perspective to her articles. Emma\'s love for entertainment and pop culture stems from her childhood fascination with movies and music. Her ability to connect with readers through her writing and her genuine enthusiasm for the industry have made her a beloved figure among fans and celebrities alike.', 'emma', 'staff', 'hafiedzhelmi@gmail.com'),
(12, '$2y$10$ui7GBGxSGsfrJqt6qi9P8.ykYNmicejYb6NRLfYhzesKSVc05DgmW', 'Jack Melt', 'Jack Melt is a tech-savvy journalist and technology enthusiast known for his in-depth knowledge and passion for all things tech-related. With a background in computer science, Jack combines his technical expertise with his storytelling skills to break down complex concepts and make them accessible to a wide audience. From the latest gadgets to emerging technologies, Jack keeps his finger on the pulse of the tech world, delivering timely and informative articles. His engaging writing style, coupled with his ability to anticipate industry trends, has garnered him a loyal following of tech enthusiasts who rely on his insights to stay ahead in the rapidly evolving digital landscape.', 'jack', 'staff', 'mahafiedzhelmi@gmail.com'),
(13, '$2y$10$YP2S8sGbvZ.xHy8h7uIN0..v7lBbSQXVkBeSnH/luhLcMfs63gwJG', 'ace', NULL, 'akmal', 'reader', 'akmal020507@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `categoryid` (`categoryid`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`),
  ADD CONSTRAINT `article_ibfk_2` FOREIGN KEY (`categoryid`) REFERENCES `category` (`categoryid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
