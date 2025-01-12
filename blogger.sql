-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 12, 2025 at 03:50 PM
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
-- Database: `blogger`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `excerpt` text DEFAULT NULL,
  `meta_description` varchar(160) DEFAULT NULL,
  `category_id` bigint(20) NOT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `status` enum('draft','published','scheduled','pending') NOT NULL DEFAULT 'pending',
  `scheduled_date` datetime DEFAULT NULL,
  `author_id` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `views` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `slug`, `content`, `excerpt`, `meta_description`, `category_id`, `featured_image`, `status`, `scheduled_date`, `author_id`, `created_at`, `updated_at`, `views`) VALUES
(48, 'How I’d learn ML in 2025 (if I could start over)', 'All you need to learn ML in 2025 is a laptop and a list of the steps you must take.', 'I said that last year, and I’ll say it again.\r\n\r\nBut now, I am a research scientist at one of the best AI startups in the world, and it took me over 6 years to get to this point.\r\n\r\nAnd nowadays, you have so many new, amazing resources that way too few people know of!\r\n\r\nSo, today, I will share how I would learn ML if I could start over by revealing the six key steps you need to take.\r\n\r\nLet‘s get going!\r\n\r\nPython\r\nWell, this one feels obvious, doesn’t it? But what’s not so obvious is how much Python you should learn at this stage.\r\n\r\nIn general, all these steps don’t have to be strictly completed in any particular order, but I would not start with the final and arguably most important step.\r\n\r\nThat said, what I highly recommend starting with is learning the basics of Python.\r\n\r\nPython is THE programming language used by pretty much everyone working on machine learning, and every other step on this list builds on top of it.\r\n\r\nSo, I would definitely want to learn what a list or dictionary are and how to write a simple if-else statement or a for loop…\r\n\r\n', NULL, NULL, 28, NULL, 'published', '2025-01-24 23:15:00', 13, '2025-01-11 22:15:39', '2025-01-11 22:15:39', 0),
(54, 'Why the Idea of Identity Is Broken', '‘You are not a drop in the ocean. You are the entire ocean in a drop.’ —Rumi', 'When I was a child the seemingly innocent question, “What do you want to be when you grow up?,” always left me unsettled. It wasn’t merely about choosing a future profession. It was an invitation to conform to pre-existing societal labels and expectations.\r\n\r\nFrom gender-specific toys, color-coded clothing, and rigid roles portrayed in cartoons, I was immersed in a world demanding adherence to strict categories. Boys were discouraged from “acting like a girl,” bravery was the mandated response to fear, and deviations from these norms were often met with ridicule or correction.\r\n\r\nThis early exposure to categorical thinking led me to a critical question:\r\n\r\nAre we limiting human potential by dividing life into neat boxes, and can embracing a more fluid understanding of identity unlock greater possibilities for individual and societal growth?\r\n\r\nPhilosophical Perspectives\r\nThe struggle to define identity is a timeless human endeavor. From the ancient Greek injunction “Know thyself” (γνῶθι σεαυτόν) to modern philosophical debates, the essence of the self remains elusive.\r\n\r\nCommon adages like ‘old dogs can’t learn new tricks’ reflect the notion that fundamental aspects of a person’s character are unchangeable. Many cultures emphasize the constancy of identity, valuing tradition and continuity over change.\r\n\r\nFor instance, in Aztec society, individuals were born into specific social classes, such as nobles (pipiltin), commoners (macehualtin), or even slaves (tlacotin), and remained within these roles throughout their lives. Their status determined their occupation, rights, and societal expectations, reinforcing the idea of a fixed identity.\r\n\r\nSimilarly, in caste-based systems, like those historically present in India, an individual’s social status and occupational roles were predetermined by birth (Dumont, 1980).\r\n\r\nDavid Hume, an influential figure in empiricist philosophy, challenged the notion of a permanent self. In his Treatise of Human Nature, Hume posited that the self is nothing more than a bundle of perceptions in perpetual flux, with no underlying substance that remains the same (Hume, 1739).\r\n\r\nAdditionally, eastern philosophies offer alternative perspectives that further emphasize the fluidity of identity. Buddhism introduces the concept of Anatta, or non-self, asserting that the idea of a permanent, unchanging self is an illusion (Rahula, 1959).\r\n\r\nThe Buddha taught about the five aggregates (skandhas): form, sensation, perception, mental formations, and consciousness. These aggregates are in constant flux, and what we consider the “self” is merely a temporary assembly of these changing components (Harvey, 1990).\r\n\r\nThinkers like Hume and Eastern philosophies challenge the notion of a permanent self, arguing instead for a fluid, ever-changing identity. Exploring the biological foundations of identity deepens this discussion: if both philosophy and biology suggest that change is central to existence, does the constant transformation of our bodies and brains confirm a fluid identity, or is there something innate that maintains a sense of continuity within us?\r\n\r\nBiology of Identity\r\nScience does not help clarify the philosophical debate around identity. is Our bodies and brains are in flux, with cellular regeneration constantly renewing cells (Spalding et al., 2005) and neural plasticity allowing new brain connections to form in response to experiences (Kolb & Gibb, 2011).\r\n\r\nAmidst this physical change, neuroscience highlights the brain’s default mode network (DMN) as key to our sense of identity, especially during self-referential thought and memory recall (Buckner et al., 2008). The DMN itself adapts, suggesting that while neural correlates to identity exist, they are dynamic rather than fixed.\r\n\r\nMemory, traditionally seen as central to identity, is also surprisingly unreliable. Locke argued that selfhood relies on continuous memory (Locke, 1690), yet research reveals that memories — especially those tied to our sense of self — are malleable.\r\n\r\nIn one study, participants recalled personal events but were subtly influenced by external information, leading them to form distorted self-referential memories (Mazzoni & Vannucci, 2007). This demonstrates how memories of our own experiences can be reshaped by suggestions or social interactions, altering even our sense of who we are.\r\n\r\nSimilarly, cases of amnesia show that even when autobiographical memories fade, certain core traits often persist (Kopelman et al., 2009), suggesting that identity encompasses intrinsic characteristics beyond conscious memory.\r\n\r\nSocietal Constructs and the Shaping of Identity\r\nSocietal Constructs of Identity\r\nImage by Author\r\nWhile memory plays a key role in shaping personal identity, it is only one part of a much larger picture. Identity also forms through interactions with society, where external pressures and expectations influence who we become. Societal constructs and relationships mold our sense of self just as powerfully as internal processes, introducing the concept of an authentic or ‘true self’ beneath social roles.\r\n\r\nThe privilege of a lifetime is to become who you truly are — Carl Jung\r\n\r\nDonald Winnicott, a prominent British pediatrician and psychoanalyst, contributed significantly to understanding the true self, which he described as the core of an individual’s being, encompassing genuine feelings, desires, and spontaneous impulses that emerge in safe, non-judgmental environments (Winnicott, 1960). This true self is measured by assessing an individual’s congruence between personal values and their actions, often using psychological scales that quantify alignment between intrinsic motivations and external behaviors (Sheldon et al., 1997).\r\n\r\nConversely, the false self acts as a protective facade that develops when individuals suppress authentic desires to gain approval or avoid negative consequences, manifesting in behaviors that don’t reflect their inner experiences but instead meet societal expectations. For instance, a child with artistic inclinations may feel compelled to prioritize subjects like science if these are highly valued by family, leading to a disconnect from their true self.\r\n\r\nWinnicott emphasized that while the false self isn’t inherently negative, it becomes problematic when it overshadows the true self, resulting in feelings of emptiness or inauthenticity. Research supports this, as individuals acting incongruently with their true selves experience lower well-being and heightened negative emotions (Sheldon et al., 1997). Building on this, developmental psychologist Erik Erikson suggested that identity forms through resolving conflicts at different life stages, particularly during adolescence, when individuals explore roles, beliefs, and ideas to create a coherent sense of self (Erikson, 1950).\r\n\r\nErikson’s ‘psychosocial moratorium,’ a period where adolescents freely explore different identities without commitment, has been shown to foster self-esteem and adaptability. Studies on gap years and cross-cultural practices like the Australian Aboriginal Walkabout further illustrate the benefits of such exploratory phases for identity development (Heath, 2007; McDonald, 2001). By integrating personal desires with social roles, individuals reduce the risk of identity diffusion, strengthening their sense of self and resilience. Nevertheless, categories and labels in society, while simplifying social dynamics, can also restrict personal identity.”\r\n\r\nThe Paradox of Categories: Necessity and Limitation\r\nThe Paradox of Categories\r\nImage by Author\r\nInternalized beliefs about identity can unconsciously limit our self-determination, often by convincing us that we are not “enough” of something to pursue certain actions or dreams. This kind of thinking — “I am not X, so I won’t do Y” — is rooted in categorical identities that may feel true but are often self-imposed or socially constructed. Such limiting beliefs create boundaries between us and the possibilities of growth, exploration, or fulfillment.\r\n\r\nWe tend to categorize ourselves based on roles or attributes — such as gender, ethnicity, profession, or even personality types — and these labels become mental shortcuts for navigating life. However, when these identities are internalized too deeply, they can lead to self-sabotaging patterns. For example, “I am not a creative person, so I won’t try to paint,” or “I’m not an academic, so I won’t attempt higher education,” are ways we unconsciously close doors. This belief system reduces our sense of autonomy and stifles potential.\r\n\r\n“I’ve never been good with numbers, so data analysis or learning statistics just isn’t something I could ever do.”\r\n\r\n“I’ve always been the quiet one in my group, so leading a team or managing a project would be impossible for me.”\r\n\r\n“I’ve always hated public speaking, so giving a presentation in front of a crowd is out of the question for me.”\r\n\r\nThe danger lies in how these thoughts become automatic, operating beneath conscious awareness. Over time, they shape the choices we make and, more importantly, the ones we don’t. This restriction of possibilities robs us of the chance to encounter the unknown — where discovery, growth, and even happiness often lie.\r\n\r\nBelonging to certain groups or adopting roles gives us a sense of security, but it also enforces rigid boundaries that may not align with our true selves. We need to deeply question these subconscious beliefs because they are often based on societal-imposed categories made by people with fundamentally different priorities and interest than ours.\r\n\r\n“Becoming is better than being. The fixed mindset does not allow people the luxury of becoming. They have to already be.” — Carol S. Dweck\r\n\r\nBeyond Identity\r\nBeyond Identity\r\nImage by Author\r\nPsychological research supports the benefits of expanding one’s identity beyond the individual self. Patricia Linville’s concept of self-complexity suggests that perceiving oneself through multiple roles builds resilience and lowers stress (Linville, 1987).\r\n\r\nAt the smallest scale, we often incorporate objects into our identity, a phenomenon known as the endowment effect, where ownership increases perceived value (Thaler, 1980). Neuroimaging supports this, showing that ownership activates brain regions tied to self-processing, subtly blending the lines between self and other (Kim & Johnson, 2012).\r\n\r\nMoving outward, connecting with others — such as through immersive technologies like virtual reality — can further expand our identity. Virtual Reality systems like The Machine to Be Another enable users to experience others’ perspectives, fostering empathy and challenging rigid self-concepts (Bertrand et al., 2018).\r\n\r\nAt the broadest scale, nature becomes a powerful extension of identity. The Connectedness to Nature Scale (CNS) reveals that a strong sense of unity with the natural world correlates with personal well-being and prosocial behavior, suggesting that embracing nature as part of self fosters growth and ecological concern (Mayer & Frantz, 2004).\r\n\r\nIn many indigenous cultures, identity inherently includes communal and ecological systems, as seen in the Hadza people’s practice of communal sharing over individual ownership, emphasizing interdependence over separation (Apicella et al., 2014). By expanding identity from possessions to people to nature, we create a fluid and connected sense of self that transcends rigid boundaries.\r\n\r\nPractical Implications\r\nApplying these insights to daily life involves consciously challenging categorical thinking and embracing personal authenticity. One effective approach is through meditation practices that emphasize the fluid and interconnected nature of the self, as found in certain Indian traditions.\r\n\r\nFor instance, Advaita Vedanta, a non-dualistic school of Hindu philosophy, promotes the practice of self-inquiry (Atma Vichara), which involves deep contemplation of the question “Who am I?” initiated by the sage Ramana Maharshi.\r\n\r\nPractitioners begin by sitting in a comfortable position, calming the mind through focused breathing, and then continuously directing their attention inward with the inquiry “Who am I?” This persistent questioning helps dissolve the identification with the ego and external roles, guiding individuals to realize the unity of the individual self (Atman) with the universal consciousness (Brahman) (Ramana Maharshi, 1985).\r\n\r\nSimilarly, Buddhist meditation techniques, such as Vipassana (insight meditation), focus on observing the impermanent nature of thoughts, feelings, and bodily sensations to cultivate a direct understanding of Anatta, or non-self (Goenka, 1987). In Vipassana, practitioners typically sit quietly, bringing mindful awareness to the breath and then systematically scanning the body to observe sensations without attachment or judgment.\r\n\r\nBoth practices encourage a shift from a fixed, isolated identity to a more fluid and interconnected sense of self, fostering greater emotional resilience, empathy, and a profound sense of unity with the world around them. Studies have shown that such meditation practices can lead to structural and functional changes in the brain, enhancing cognitive flexibility and reducing stress, thereby supporting the psychological benefits of transcending the traditional ego-bound self (Brewer et al., 2011; Lazar et al., 2005).\r\n\r\nConclusion\r\nTaoism offers a perspective that emphasizes harmony with the natural flow of the universe and diminishes the ego’s prominence. Central to Taoist philosophy is the concept of wu wei, often translated as “non-action” or “effortless action.”\r\n\r\nThis principle encourages individuals to align with the Tao — the fundamental essence that underlies all reality — by acting naturally and spontaneously without forcing personal agendas (Lao Tzu, circa 4th century BCE). For example, a musician deeply immersed in playing, without conscious effort or self-awareness, exemplifies wu wei.\r\n\r\nIn light of wu wei, our understanding of identity shifts from a rigid construct to a fluid, responsive state. Like water, identity need not be confined to predetermined shapes or labels; instead, it can flow and transform with our evolving thoughts, relationships, and self-understanding.\r\n\r\nNext time someone asks you what you are, consider answering, “I am water.” This simple yet powerful statement reflects an understanding that, like water, we are formless and adaptable, capable of flowing into any aspect of life without being confined by it. By embracing a fluid understanding of identity, we give ourselves and others the freedom to evolve, adapt, and bring forth the richness within our minds.\r\n\r\nAs Bruce Lee stated:\r\n\r\n“Empty your mind, be formless, shapeless — like water.\r\nIf you put water into a cup, it becomes the cup.\r\nYou put water into a bottle, it becomes the bottle.\r\nYou put it in a teapot, it becomes the teapot.\r\nWater can flow or it can crash.\r\nBe water, my friend.” (Lee, 1971)\r\n\r\nReferences\r\nBuckner, R. L., Andrews-Hanna, J. R., & Schacter, D. L. (2008). The brain’s default network: Anatomy, function, and relevance to disease. Annals of the New York Academy of Sciences, 1124(1), 1–38.\r\nDumont, L. (1980). Homo Hierarchicus: The Caste System and Its Implications. University of Chicago Press.\r\nErikson, E. H. (1950). Childhood and Society. W. W. Norton & Company.\r\nHarvey, P. (1990). An Introduction to Buddhism: Teachings, History and Practices. Cambridge University Press.\r\nHume, D. (1739). A Treatise of Human Nature.\r\nKolb, B., & Gibb, R. (2011). Brain plasticity and behaviour in the developing brain. Journal of the Canadian Academy of Child and Adolescent Psychiatry, 20(4), 265–276.\r\nKopelman, M. D., Wilson, B. A., & Baddeley, A. D. (2009). The Essentials of Neuropsychological Rehabilitation. Oxford University Press.\r\nLocke, J. (1690). An Essay Concerning Human Understanding. Thomas Bassett.\r\nMcDonald, E. (2001). Walkabout: A Rite of Passage for Adolescent Boys. Australian Institute of Aboriginal and Torres Strait Islander Studies.\r\nMeeus, W., Iedema, J., Helsen, M., & Vollebergh, W. (1999). Patterns of adolescent identity development: Review of literature and longitudinal analysis. Developmental Review, 19(4), 419–461.\r\nNaran, Kamal. (2023). Using art therapy to address the protective false self when working with queer identity. South African Journal of Arts Therapies, 1, 89–110.\r\nRahula, W. (1959). What the Buddha Taught. Grove Press.\r\nSheldon, K. M., Ryan, R., Rawsthorne, L. J., & Ilardi, B. (1997). Trait self and true self: Cross-role variation in the Big-Five personality traits and its relations with psychological authenticity and subjective well-being. Journal of Personality and Social Psychology, 73(6), 1380–1393.\r\nSpalding, K. L., Bhardwaj, R. D., Buchholz, B. A., Druid, H., & Frisén, J. (2005). Retrospective birth dating of cells in humans. Cell, 122(1), 133-143.\r\nWinnicott, D. W. (1960). Ego distortion in terms of true and false self. In The Maturational Processes and the Facilitating Environment (pp. 140–152). International Universities Press.', NULL, NULL, 24, NULL, 'published', '2025-01-12 14:31:00', 14, '2025-01-12 13:31:11', '2025-01-12 13:31:15', 0),
(55, 'Labore minus exercit', 'Optio minus illo cu', 'Voluptatibus harum e', NULL, NULL, 29, NULL, 'published', '1978-08-10 04:49:00', 12, '2025-01-12 14:23:24', '2025-01-12 14:23:33', 0);

-- --------------------------------------------------------

--
-- Table structure for table `article_tags`
--

CREATE TABLE `article_tags` (
  `article_id` bigint(20) UNSIGNED NOT NULL,
  `tag_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(19, 'Sport'),
(24, 'Lifestyle'),
(25, 'Health'),
(26, 'Travel'),
(28, 'Technology'),
(29, 'Lifestyle'),
(38, 'Wars');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`) VALUES
(23, 'Productivity'),
(24, 'Wellness'),
(25, 'Adventure'),
(26, 'Tutorial'),
(27, 'Innovation'),
(28, 'Productivity'),
(29, 'Wellness'),
(30, 'Adventure'),
(31, 'Tutorial'),
(32, 'Politics'),
(33, 'Fc Barça');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `bio` text DEFAULT NULL,
  `profile_picture_url` varchar(255) DEFAULT NULL,
  `role` enum('user','author','admin') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password_hash`, `bio`, `profile_picture_url`, `role`) VALUES
(4, 'kudo', 'rayanpro2023@gmail.com', '$2y$10$HI0tMKGWEXg3L0NJY22FkO8XL1Q5o..WtwMEWNeTJ5B.I4BRoJljK', NULL, NULL, 'admin'),
(11, 'rayanc', 'rayan@gmail.com', '$2y$10$Vz7ogA1JjavUvhpqmmutouRZ1lz4zC3BsuC/PQJb3P7jWjnHLZ84G', 'Currently first year, developing web apps & mobiles; ex freelencer', 'https://cdn.sofifa.net/players/209/981/25_120.png', 'user'),
(12, 'aymane', 'aymane@gmail.com', '$2y$10$xe6WVtElZmTYmQP2tdqIE.odsFdxImbniiW7mZXObXMroAQ3Y0/Ki', 'bonjour', 'https://cdn.sofifa.net/players/231/747/25_120.png', 'user'),
(13, 'imane', 'imane1976@gmail.com', '$2y$10$AK5bHEokTq8pU9HbPOvS9.kBZkeBY.Umk/.leRfwIEabS0eRwoRwC', 'mljshfmqoezfnazî,^zoripcziorj,qorc', 'https://cdn.sofifa.net/players/203/376/25_120.png', 'user'),
(14, 'rayan elgue', 'kudokon46@gmail.com', '$2y$10$A3seuCFAA9StFKxe6QN5MeUM/Z/cmFpCAFovv4bDn2J/QHjbj36jO', 'Yo !', 'https://cdn.sofifa.net/players/209/981/25_120.png', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `author_id` (`author_id`);

--
-- Indexes for table `article_tags`
--
ALTER TABLE `article_tags`
  ADD PRIMARY KEY (`article_id`,`tag_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `articles_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `article_tags`
--
ALTER TABLE `article_tags`
  ADD CONSTRAINT `article_tags_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `article_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
