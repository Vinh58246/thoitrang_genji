-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 26, 2024 at 03:45 PM
-- Server version: 8.0.30
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thoitrang_genji`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `display_order` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`, `status`, `display_order`, `created_at`, `slug`) VALUES
(2, 'áo thun', 'cate_aothun.jpg', 0, 1, '2024-12-16 16:21:08', 'ao-thun'),
(3, 'áo polo', 'cate_aopolo.jpg', 0, 2, '2024-12-16 16:21:08', 'ao-polo'),
(4, 'áo sơ mi', 'cate_aosomi.webp', 0, 3, '2024-12-16 16:21:08', 'ao-so-mi'),
(5, 'áo khoác', 'cate_aokhoac.jpg', 0, 4, '2024-12-16 16:21:08', 'ao-khoac'),
(6, 'quần dài', 'cate_quandai.jpg', 1, 5, '2024-12-16 16:21:08', 'quan-dai'),
(7, 'quần jean', 'cate_quanjean.jpg', 0, 6, '2024-12-16 16:21:08', 'quan-jean'),
(8, 'quần short', 'cate_quanshort.webp', 0, 7, '2024-12-16 16:21:08', 'quan-short');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `idproduct` int NOT NULL,
  `iduser` int NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `evaluate` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `level_comment` int NOT NULL DEFAULT '0',
  `parent_id` int DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `linking_variant_attributes`
--

CREATE TABLE `linking_variant_attributes` (
  `id` int NOT NULL,
  `idproduct` int NOT NULL,
  `linking` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int DEFAULT NULL,
  `quantity` int NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `list_image_comment`
--

CREATE TABLE `list_image_comment` (
  `id` int NOT NULL,
  `idcomment` int NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `list_image_product`
--

CREATE TABLE `list_image_product` (
  `id` int NOT NULL,
  `idproduct` int NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_order` int DEFAULT NULL,
  `size_image` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `list_image_product`
--

INSERT INTO `list_image_product` (`id`, `idproduct`, `image`, `display_order`, `size_image`) VALUES
(214, 5, 'aothun_1_5.jpg', 0, 721546),
(215, 5, 'aothun_1_4.jpg', 1, 638425),
(216, 5, 'aothun_1_3.jpg', 2, 536901),
(217, 5, 'aothun_1_2.webp', 3, 320722),
(218, 5, 'aothun_1_1.jpg', 4, 378679),
(219, 7, 'quandai_1_6.webp', 0, 308530),
(220, 7, 'quandai_1_5.webp', 1, 373608),
(221, 7, 'quandai_1_4.jpg', 2, 580573),
(222, 7, 'quandai_1_3.webp', 3, 29232),
(223, 7, 'quandai_1_2.webp', 4, 53440),
(224, 7, 'quandai_1_1.webp', 5, 54936),
(225, 8, 'aokhoac_1_1.webp', 0, 96144),
(226, 8, 'aokhoac_1_2.webp', 1, 53138),
(227, 8, 'aokhoac_1_3.webp', 2, 160316),
(228, 8, 'aokhoac_1_4.webp', 3, 331506),
(229, 8, 'aokhoac_1_5.webp', 4, 254814),
(230, 8, 'aokhoac_1_6.jpg', 5, 478954),
(231, 8, 'aokhoac_1_7.jpg', 6, 709000),
(232, 8, 'aokhoac_1_8.webp', 7, 249996),
(233, 9, 'quanshort_1_10.webp', 0, 525466),
(234, 9, 'quanshort_1_9.jpg', 1, 665258),
(235, 9, 'quanshort_1_8.jpg', 2, 549899),
(236, 9, 'quanshort_1_7.webp', 3, 185502),
(237, 9, 'quanshort_1_6.jpg', 4, 302952),
(238, 9, 'quanshort_1_5.jpg', 5, 395873),
(239, 9, 'quanshort_1_4.webp', 6, 178334),
(240, 9, 'quanshort_1_3.jpg', 7, 357428),
(241, 9, 'quanshort_1_2.jpg', 8, 369668),
(242, 9, 'quanshort_1_1.jpg', 9, 379381);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `display` tinyint(1) NOT NULL DEFAULT '0',
  `number_of_views` int NOT NULL DEFAULT '0',
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `order_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` tinyint(1) NOT NULL,
  `shipping_price` int NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` int NOT NULL,
  `order_status` tinyint(1) NOT NULL,
  `updated_at` timestamp NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_code`, `payment_status`, `shipping_price`, `payment_method`, `address`, `phone`, `order_status`, `updated_at`, `created_at`) VALUES
(2, '#GJ13841', 0, 30000, 'thanh toán bằng momo', '123, trường trịn, sóc trăngk', 326625975, 1, '2024-12-24 13:37:41', '2024-12-24 13:34:47'),
(3, '#GJ27642', 0, 30000, 'thanh toán bằng tiền mặt', '456, skira, hattv m, âfaffe', 27575787, 1, '2024-12-24 13:34:47', '2024-12-24 13:34:47'),
(4, '#GJ35643', 1, 30000, 'thanh toán bằng momo', '595,vdjvid, divjd,vjjvd', 745625975, 2, '2024-12-24 13:37:13', '2024-12-24 13:37:13'),
(5, '#GJ48642', 0, 30000, 'thanh toán bằng tiền mặt', '456, skira, hattv m, âfaffe', 745753975, 4, '2024-12-24 13:37:13', '2024-12-24 13:37:13'),
(8, '#GJ53644', 1, 30000, 'thanh toán bằng tiền mặt', '483,jjia, fheuhf,fjeif', 686625975, 2, '2024-12-24 17:16:13', '2024-12-24 17:16:13'),
(9, '#GJ65928', 1, 30000, 'thanh toán bằng momo', '262, jifejfm, fjefemc', 572373975, 0, '2024-12-24 17:16:13', '2024-12-24 17:16:13');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `idcategory` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detailed_description` text COLLATE utf8mb4_unicode_ci,
  `product_summary` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int NOT NULL,
  `hot` tinyint NOT NULL DEFAULT '0',
  `status` tinyint NOT NULL DEFAULT '0',
  `views` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `idcategory`, `name`, `image`, `detailed_description`, `product_summary`, `price`, `hot`, `status`, `views`, `created_at`, `slug`) VALUES
(5, 2, 'Áo Thun Nam Họa Tiết In-Thêu Smashers Form Regular', 'aothun_1_1.jpg', NULL, 'Thiết kế với chi tiết in thêu cùng gam màu đen chủ đạo, áo dễ dàng kết hợp với nhiều loại trang phục khác nhau như quần tây, quần jeans hay quần jogger, mang lại sự linh hoạt và phong cách cho mọi dịp.', 349000, 0, 0, 0, '2024-12-16 16:48:30', 'ao-thun-nam-hoa-tiet-in-theu-smashers-form-regular'),
(6, 4, 'Áo Sơ Mi Cuban Vải Dệt Nam Raised Velvet Stripe Form Relaxed', 'aosomi_1_1.jpg', NULL, 'Thiết kế áo sơ mi tinh giản với cổ Cuban và gam màu be nâu mang đến vẻ hiện đại, dễ phối và phù hợp với mọi hoàn cảnh.', 319000, 1, 0, 0, '2024-12-16 16:48:30', 'ao-so-mi-cuban-vai-det-nam-raised-velvet-stripe-form-relaxed'),
(7, 6, 'Quần Tây Nam Ống Ôm Sibetab Modern Design Form Slim', 'quandai_1_1.webp', NULL, 'Quần Tây Slim-Fit Sibetab Modern Design là sự lựa chọn lý tưởng cho người mặc yêu thích phong cách đương đại nhưng vẫn muốn giữ nét lịch lãm truyền thống.', 420000, 0, 0, 0, '2024-12-16 16:48:30', 'quan-tay-nam-ong-om-sibetab-modern-design-form-slim'),
(8, 5, 'Áo Khoác Dù Nam Lót Poly Heroic Form Regular', 'aokhoac_1_1.webp', NULL, 'Form dáng Regular tạo sự thoải mái mà không ôm sát, dễ dàng phối hợp với các phong cách casual hay street style, thích hợp cho nhiều kiểu cơ thể và hoạt động hàng ngày.', 519000, 0, 0, 0, '2024-12-16 16:48:30', 'áo-khoác-du-nam-lot-poly-heroic-form-regular'),
(9, 8, 'Quần Short Kaki Nam Garment Dye Form Regular', 'quanshort_1_1.jpg', NULL, 'Quần có thiết kế túi khóa kéo một bên giúp giữ các vật dụng cá nhân như điện thoại, ví được an toàn khi di chuyển. Các gam màu trung tính, dễ phối, có tính ứng dụng cao.', 319000, 0, 0, 0, '2024-12-16 16:48:30', 'quan-short-kaki-nam-garment-dye-form-regular'),
(10, 7, 'Quần Jean Nam Xám Wash Ống Ôm Form SmartFit', 'quanjean_1_1.jpg', NULL, 'Thiết kế hiệu ứng wash sáng ở hai ống quần và chi tiết râu ria nhẹ nhàng, tạo nên vẻ ngoài phóng khoáng, cá tính và mang lại phong cách riêng biệt.', 550000, 0, 0, 0, '2024-12-16 16:48:30', 'quan-jean-nam-xam-wash-ong-om-form-smartfit'),
(11, 3, 'Áo Polo Nam Họa Tiết Knitted Pattern Form Regular', 'aopolo_1_1.webp', NULL, 'Áo polo với họa tiết monogram độc đáo, mang đến phong cách thời trang trẻ trung và thời thượng. Thiết kế hiện đại, dễ dàng kết hợp cùng nhiều loại trang phục, phù hợp trong mọi hoàn cảnh.', 399000, 0, 0, 0, '2024-12-16 17:06:54', 'ao-polo-nam-hoa-tiet-knitted-pattern-form-regular'),
(12, 5, 'Áo Khoác Dù Nam Có Nón Drafting Breathable Form Regular', 'aokhoac_2_1.webp', NULL, 'Thiết kế lịch lãm với màu sắc thời trang, rã phần sườn thoáng khí, tăng sự thoải mái khi vận động. Túi trong tiện lợi là điểm nhấn, giúp dễ dàng lưu trữ vật dụng cá nhân.', 449000, 1, 0, 0, '2024-12-16 17:37:08', 'ao-khoac-du-nam-co-non-drafting-breathable-form-regular'),
(13, 8, 'Quần Short Kaki Nam Cargo Garment Dye Form Regular', 'quanshort_2_1.jpg', NULL, 'Thiết kế quần short nổi bật với hai túi hộp ở hai bên giúp tăng thêm độ cá tinh, bụi bặm. Hai túi hộp tiện dụng còn có thể dùng để mang theo các vật dụng cá nhân như ví, điện thoại.', 379000, 0, 0, 0, '2024-12-16 17:37:08', 'quan-short-kaki-nam-cargo-garment-dye-form-regular'),
(14, 2, 'Áo thun Nam Trơn Prominent Line Form Regular', 'aothun_2_1.webp', NULL, 'Điểm nhấn của thiết kế áo nằm ở hai đường kẻ màu tương phản chạy dọc từ vai đến tay tạo nên nét riêng độc đáo. Áo với thiết kế hướng đến sự tối giản với hai gam màu trung tính trắng, đen giúp dễ phối với nhiều trang phục khác nhau.', 299000, 0, 0, 0, '2024-12-16 17:37:08', 'ao-thun-nam-tron-prominent-line-form-regular'),
(15, 4, 'Áo Sơ Mi Linen Nam Tay Dài Coastal Breeze Form Regular', 'aosomi_2_1.jpg', NULL, 'Thiết kế đơn giản, thanh lịch, lý tưởng cho trang phục thường ngày hoặc những dịp cần sự sang trọng mà vẫn đảm bảo sự thoải mái. Điểm nhấn tinh tế là dây dệt trang trí ở phần cổ.', 389000, 0, 0, 0, '2024-12-16 17:37:08', 'ao-so-mi-linen-nam-tay-dai-coastal-breeze-form-regular'),
(17, 3, 'Áo Polo Nam Phối Bo Cổ Houndstooth Pattern Form Regular', 'aopolo_2_1.webp', NULL, 'Thiết kế với họa tiết Houndstooth - răng sói - cùng tông màu trắng thanh lịch tạo điểm nhấn độc đáo, kết hợp giữa cổ điển và hiện đại, mang đến phong cách thời trang tinh tế, sang trọng.', 349000, 0, 0, 0, '2024-12-16 17:37:08', 'ao-polo-nam-phoi-bo-co-houndstooth-pattern-form-regular'),
(18, 6, 'Quần Jogger Pique Nam Mythical Figures Form Regular', 'quandai_2_1.jpg', NULL, 'Chi tiết các con số gắn liền với bóng rổ như 8, 0 và 23 được thêu đắp tinh tế, tạo điểm nhấn và mang đến ý nghĩa đặc biệt cho chiếc quần.', 419000, 0, 0, 0, '2024-12-16 17:37:08', 'quan-jogger-pique-nam-mythical-figures-form-regular'),
(26, 4, 'Áo Sơ Mi Cuban Viscose Nam Tay Ngắn Graffiti Pattern Form Relaxed', 'aosomi_3_1.webp', NULL, 'Áo có cổ Cuban lịch lãm, kết hợp với họa tiết Graffiti phủ đầy bề mặt, tạo nên phong cách đường phố độc đáo và là sự lựa chọn hoàn hảo cho những ai muốn khẳng định phong cách riêng.', 319000, 0, 0, 0, '2024-12-16 18:00:55', 'ao-so-mi-cuban-viscose-nam-tay-ngan-graffiti-pattern-form-relaxed'),
(27, 8, 'Quần Short Nỉ Chân Cua Túi Hộp Cargo Nam Form Regular', 'quanshort_3_1.jpg', NULL, 'Thiết kế lưng quần có lót thun và dây rút, cùng các túi tiện dụng nổi bật với túi hộp hai bên sườn không chỉ mang lại điểm nhấn thẩm mỹ mà còn cực kỳ tiện ích, phù hợp cho phong cách sống năng động, hiện đại.', 419000, 0, 0, 0, '2024-12-16 18:00:55', 'quan-short-ni-chan-cua-tui-hop-cargo-nam-form-regular'),
(28, 2, 'Áo Thun Nam Họa Tiết Thêu Đắp Textile Applique Form Regular', 'aothun_3_1.jpg', NULL, 'Thiết kế áo độc đáo với hiệu ứng wash xám đậm và nhạt mang đến vẻ bụi bặm đầy cá tính. Điểm nhấn nổi bật nằm ở chi tiết thêu nổi và thêu đắp tinh xảo ở cả mặt trước lẫn mặt sau, tạo nét phá cách ấn tượng.', 349000, 0, 0, 0, '2024-12-16 18:00:55', 'ao-thun-nam-hoa-tiet-theu-dap-textile-applique-form-regular'),
(29, 3, 'Áo Polo Nam Phối Sọc Tay The Baseball Dog Form Regular', 'aopolo_3_1.jpg', NULL, 'Áo nổi bật với chi tiết sọc hai bên tay áo cùng hình thêu chú chó chơi bóng chày ở ngực trái, mang lại sự trẻ trung, năng động và phù hợp với những người yêu thích phong cách thể thao, vui tươi.', 389000, 0, 0, 0, '2024-12-16 18:00:55', 'ao-polo-nam-phoi-soc-tay-the-baseball-dog-form-regular'),
(30, 7, 'Quần Jean Nam Trắng Trơn Ống Ôm Form Skinny', 'quanjean_3_1.webp', NULL, 'Màu trắng tinh khôi làm nổi bật sự thanh lịch và sạch sẽ của chiếc quần, tạo nên điểm nhấn thu hút mọi ánh nhìn. Màu trắng cũng dễ dàng phối hợp với nhiều loại áo khác nhau.', 399000, 0, 0, 0, '2024-12-16 18:00:55', 'quan-jean-nam-trang-tron-ong-om-form-skinny'),
(31, 6, 'Quần Jogger Kaki Nam Form Regular', 'quandai_3_1.webp', NULL, 'Quần Jogger Kaki Regular là sự lựa chọn đa năng cho nhiều hoàn cảnh khác nhau. Từ những buổi tập thể dục nhẹ, đi chơi hay thậm chí làm việc, quần jogger này đều làm nổi bật phong cách của bạn.', 349000, 0, 0, 0, '2024-12-16 18:00:55', 'quan-jogger-kaki-nam-form-regular'),
(32, 5, 'Áo Khoác Varsity Vải Dạ Nam Phối Viền Form Regular', 'aokhoac_3_1.webp', NULL, 'Thiết kế Varsity phong cách thể thao cổ điển với các chi tiết tinh tế như bâu cổ và bo tay, bo lai dệt phối viền gân tạo điểm nhấn.', 549000, 0, 0, 0, '2024-12-16 18:00:55', 'ao-khoac-varsity-vai-da-nam-phoi-vien-form-regular');

-- --------------------------------------------------------

--
-- Table structure for table `product_order`
--

CREATE TABLE `product_order` (
  `id` int NOT NULL,
  `idproduct` int NOT NULL,
  `idorder` int NOT NULL,
  `idlinkingvariant` int DEFAULT NULL,
  `quantity` int NOT NULL,
  `price` int NOT NULL,
  `iduser` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `variant_attribute`
--

CREATE TABLE `variant_attribute` (
  `id` int NOT NULL,
  `idvariantname` int NOT NULL,
  `value_variant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `variant_name`
--

CREATE TABLE `variant_name` (
  `id` int NOT NULL,
  `idproduct` int NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idproduct` (`idproduct`),
  ADD KEY `iduser` (`iduser`);

--
-- Indexes for table `linking_variant_attributes`
--
ALTER TABLE `linking_variant_attributes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idvariant` (`idproduct`);

--
-- Indexes for table `list_image_comment`
--
ALTER TABLE `list_image_comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idcomment` (`idcomment`);

--
-- Indexes for table `list_image_product`
--
ALTER TABLE `list_image_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idproduct` (`idproduct`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idcategory` (`idcategory`);

--
-- Indexes for table `product_order`
--
ALTER TABLE `product_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idproduct` (`idproduct`),
  ADD KEY `iduser` (`iduser`),
  ADD KEY `product_order_ibfk_2` (`idlinkingvariant`),
  ADD KEY `product_order_ibfk_1` (`idorder`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `variant_attribute`
--
ALTER TABLE `variant_attribute`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idvariantname` (`idvariantname`);

--
-- Indexes for table `variant_name`
--
ALTER TABLE `variant_name`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idproduct` (`idproduct`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `linking_variant_attributes`
--
ALTER TABLE `linking_variant_attributes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=239;

--
-- AUTO_INCREMENT for table `list_image_comment`
--
ALTER TABLE `list_image_comment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `list_image_product`
--
ALTER TABLE `list_image_product`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=389;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=745625976;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `product_order`
--
ALTER TABLE `product_order`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `variant_attribute`
--
ALTER TABLE `variant_attribute`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=375;

--
-- AUTO_INCREMENT for table `variant_name`
--
ALTER TABLE `variant_name`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`idproduct`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`iduser`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `linking_variant_attributes`
--
ALTER TABLE `linking_variant_attributes`
  ADD CONSTRAINT `linking_variant_attributes_ibfk_1` FOREIGN KEY (`idproduct`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `list_image_comment`
--
ALTER TABLE `list_image_comment`
  ADD CONSTRAINT `list_image_comment_ibfk_1` FOREIGN KEY (`idcomment`) REFERENCES `comments` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `list_image_product`
--
ALTER TABLE `list_image_product`
  ADD CONSTRAINT `list_image_product_ibfk_1` FOREIGN KEY (`idproduct`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`idcategory`) REFERENCES `categories` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `product_order`
--
ALTER TABLE `product_order`
  ADD CONSTRAINT `product_order_ibfk_1` FOREIGN KEY (`idorder`) REFERENCES `orders` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `product_order_ibfk_2` FOREIGN KEY (`idlinkingvariant`) REFERENCES `linking_variant_attributes` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `product_order_ibfk_3` FOREIGN KEY (`idproduct`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `product_order_ibfk_4` FOREIGN KEY (`iduser`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `variant_attribute`
--
ALTER TABLE `variant_attribute`
  ADD CONSTRAINT `variant_attribute_ibfk_1` FOREIGN KEY (`idvariantname`) REFERENCES `variant_name` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `variant_name`
--
ALTER TABLE `variant_name`
  ADD CONSTRAINT `variant_name_ibfk_1` FOREIGN KEY (`idproduct`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
