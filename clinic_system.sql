-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2025 at 07:41 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clinic_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `appointment_date` datetime NOT NULL,
  `status` enum('pending','approved','cancelled') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `patient_id`, `doctor_id`, `appointment_date`, `status`, `created_at`) VALUES
(1, 4, 1, '2025-06-15 01:33:00', 'pending', '2025-06-09 22:33:49');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `major_id` int(11) DEFAULT NULL,
  `consultation_fee` float DEFAULT NULL,
  `experience_years` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `name`, `major_id`, `consultation_fee`, `experience_years`, `image`, `phone`) VALUES
(1, 'د. محمد احمد', 7, 100, 15, '683fc3c5b3232.jpg', '1234567891'),
(2, 'د. أحمد عبد العال', 7, 150, 7, '683fc0113c9a0.webp', '01010011222'),
(3, 'د. محمود الشافعي', 5, 350, 9, '683fc36d10963.jpg', '1120022334'),
(4, 'د. كريم مصطفى', 5, 400, 14, '683fc446cb958.jpg', '1230033445'),
(5, 'د. سارة حسن', 5, 150, 8, '68404c4ba98b8.jpg', '1290099001'),
(6, 'د. محمد مجدي', 7, 400, 15, '684061a9712c8.webp', '1040044556');

-- --------------------------------------------------------

--
-- Table structure for table `majors`
--

CREATE TABLE `majors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `majors`
--

INSERT INTO `majors` (`id`, `name`, `description`, `image`, `created_at`) VALUES
(1, 'اسنان', 'تشخيص وعلاج أمراض الفم والأسنان، بما في ذلك الغشاء المخاطي الفموي والأنسجة المجاورة', '683e26946e466.jpg', '2025-06-02 21:32:52'),
(2, 'العيون', 'يختص بالتشخيص وعلاج أمراض العيون، بالإضافة إلى إجراء العمليات الجراحية.', '683e2735d5eed.jpg', '2025-06-02 21:35:19'),
(3, 'الأنف والأذن والحنجرة', 'يختص بالتشخيص وعلاج أمراض الأنف والأذن والحنجرة، بالإضافة إلى إجراء العمليات الجراحية', '683e2755d365e.jpg', '2025-06-02 21:36:05'),
(4, 'الأمراض الجلدية', 'يختص بالتشخيص وعلاج الأمراض الجلدية.', '683e27b2e60cd.jpg', '2025-06-02 21:37:38'),
(5, 'القلب', 'يختص بالتشخيص وعلاج أمراض القلب والأوعية الدموية', '683e27d3df903.jpg', '2025-06-02 21:38:11'),
(6, 'التخدير', 'يهتم بتخدير المرضى قبل وبعد الجراحة', '684061047a651.jpg', '2025-06-04 14:06:44'),
(7, 'المخ والأعصاب', 'الجهاز العصبي المسؤول عن إرسال واستقبال الإشارات الكهربائية والكيميائية في الجسم', '68406144a4785.webp', '2025-06-04 14:07:48');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `role` enum('patient','admin') DEFAULT 'patient',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `role`, `created_at`) VALUES
(1, 'fathyelnaa', 'fathy102@gmail.com', '$2y$10$xNO/eRkBs7ee4u9T3BRuS.CJpJCguxHZ8z.PuL3JUgFdDS.rdEfbW', '', 'admin', '2025-06-04 19:04:56'),
(2, 'fathyelnaa', 'fathy12@gmail.com', '$2y$10$nS9syhM8hu7NegbLtUWy3eRZrVuIo8eQzbRVv2NG/spgbH0NZngIC', '012345678901', 'patient', '2025-06-04 19:05:45'),
(4, 'fathyelnaa', 'fathy@gmail.com', '$2y$10$ns1meLOo5x28GU6s2QKsSuF6/qO8anaOdUQynlftMvJBlKg6QVkqi', '21474836470000', 'patient', '2025-06-09 22:33:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `major_id` (`major_id`);

--
-- Indexes for table `majors`
--
ALTER TABLE `majors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `majors`
--
ALTER TABLE `majors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_ibfk_1` FOREIGN KEY (`major_id`) REFERENCES `majors` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
