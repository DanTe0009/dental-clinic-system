-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2026 at 02:49 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dental_clinic`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appointment_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `dentist_id` int(11) NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `status` enum('Booked','Rescheduled','Cancelled') NOT NULL DEFAULT 'Booked'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appointment_id`, `patient_id`, `dentist_id`, `appointment_date`, `appointment_time`, `status`) VALUES
(1, 1, 1, '2026-06-09', '09:30:00', 'Booked'),
(2, 2, 2, '2026-06-09', '10:00:00', 'Rescheduled'),
(3, 3, 3, '2026-06-10', '11:00:00', 'Booked'),
(4, 4, 1, '2026-06-10', '14:30:00', 'Cancelled'),
(5, 5, 2, '2026-06-11', '09:00:00', 'Booked');

-- --------------------------------------------------------

--
-- Table structure for table `booked`
--

CREATE TABLE `booked` (
  `appointment_id` int(11) NOT NULL,
  `confirmation_no` varchar(50) NOT NULL,
  `booked_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booked`
--

INSERT INTO `booked` (`appointment_id`, `confirmation_no`, `booked_on`) VALUES
(1, 'CONF-2026-001', '2026-06-01'),
(3, 'CONF-2026-002', '2026-06-03'),
(5, 'CONF-2026-003', '2026-06-05');

-- --------------------------------------------------------

--
-- Table structure for table `cancelled`
--

CREATE TABLE `cancelled` (
  `appointment_id` int(11) NOT NULL,
  `cancellation_reason` text DEFAULT NULL,
  `cancelled_on` date NOT NULL,
  `cancelled_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cancelled`
--

INSERT INTO `cancelled` (`appointment_id`, `cancellation_reason`, `cancelled_on`, `cancelled_by`) VALUES
(4, 'Patient did not show up', '2026-06-10', 'Receptionist');

-- --------------------------------------------------------

--
-- Table structure for table `dental_record`
--

CREATE TABLE `dental_record` (
  `record_id` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `created_date` date NOT NULL DEFAULT curdate(),
  `allergies` text DEFAULT NULL,
  `medical_history` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dental_record`
--

INSERT INTO `dental_record` (`record_id`, `appointment_id`, `created_date`, `allergies`, `medical_history`) VALUES
(1, 1, '2026-06-09', 'Penicillin', 'Mild gum disease detected in 2024'),
(2, 2, '2026-06-09', 'None', 'Previous root canal on tooth #14 in 2023'),
(3, 3, '2026-06-10', 'Latex', 'No significant dental history'),
(4, 5, '2026-06-11', 'None', 'Wisdom tooth extraction in 2022');

-- --------------------------------------------------------

--
-- Table structure for table `dentist`
--

CREATE TABLE `dentist` (
  `dentist_id` int(11) NOT NULL,
  `dentist_name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `license_number` varchar(50) NOT NULL,
  `years_experience` int(11) NOT NULL CHECK (`years_experience` >= 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dentist`
--

INSERT INTO `dentist` (`dentist_id`, `dentist_name`, `phone`, `email`, `license_number`, `years_experience`) VALUES
(1, 'Dr. Sana Qureshi', '0301-1112222', 'sana.qureshi@clinic.com', 'PMDC-D-10234', 10),
(2, 'Dr. Kamran Shah', '0312-2223333', 'kamran.shah@clinic.com', 'PMDC-D-20567', 7),
(3, 'Dr. Rabia Farooq', '0323-3334444', 'rabia.farooq@clinic.com', 'PMDC-D-30891', 4);

-- --------------------------------------------------------

--
-- Table structure for table `dentist_specialization`
--

CREATE TABLE `dentist_specialization` (
  `dentist_id` int(11) NOT NULL,
  `specialization_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dentist_specialization`
--

INSERT INTO `dentist_specialization` (`dentist_id`, `specialization_id`) VALUES
(1, 1),
(1, 3),
(2, 2),
(2, 4),
(3, 1),
(3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_id` int(11) NOT NULL,
  `record_id` int(11) NOT NULL,
  `generated_date` date NOT NULL DEFAULT curdate(),
  `due_date` date NOT NULL,
  `status` enum('Unpaid','Partial','Paid') NOT NULL DEFAULT 'Unpaid'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_id`, `record_id`, `generated_date`, `due_date`, `status`) VALUES
(1, 1, '2026-06-09', '2026-06-23', 'Paid'),
(2, 2, '2026-06-09', '2026-06-23', 'Unpaid'),
(3, 3, '2026-06-10', '2026-06-24', 'Unpaid'),
(4, 4, '2026-06-11', '2026-06-25', 'Partial');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `patient_id` int(11) NOT NULL,
  `patient_name` varchar(100) NOT NULL,
  `age` int(11) NOT NULL CHECK (`age` > 0),
  `gender` enum('Male','Female','Other') NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `street` varchar(150) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `registration_date` date NOT NULL DEFAULT curdate(),
  `emergency_contact` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patient_id`, `patient_name`, `age`, `gender`, `phone`, `email`, `street`, `city`, `state`, `registration_date`, `emergency_contact`) VALUES
(1, 'Ahmed Raza', 28, 'Male', '0300-1234567', 'ahmed.raza@gmail.com', '12 Gulshan Block', 'Karachi', 'Sindh', '2025-01-10', 'Sara Raza: 0300-9876543'),
(2, 'Fatima Noor', 34, 'Female', '0311-2345678', 'fatima.noor@gmail.com', '45 Johar Town', 'Lahore', 'Punjab', '2025-02-14', 'Ali Noor: 0311-8765432'),
(3, 'Usman Tariq', 22, 'Male', '0321-3456789', 'usman.tariq@yahoo.com', '7 F-8 Markaz', 'Islamabad', 'ICT', '2025-03-05', 'Tariq Khan: 0321-7654321'),
(4, 'Ayesha Malik', 45, 'Female', '0333-4567890', 'ayesha.malik@gmail.com', '33 Saddar Road', 'Peshawar', 'KPK', '2025-04-20', 'Bilal Malik: 0333-6543210'),
(5, 'Bilal Hussain', 31, 'Male', '0345-5678901', 'bilal.hussain@gmail.com', '88 Model Town', 'Faisalabad', 'Punjab', '2025-05-01', 'Hina Hussain: 0345-5432109');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `amount_paid` decimal(10,2) NOT NULL CHECK (`amount_paid` > 0),
  `payment_date` date NOT NULL DEFAULT curdate(),
  `payment_method` enum('Cash','Credit Card','Debit Card','Insurance','Bank Transfer') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `invoice_id`, `amount_paid`, `payment_date`, `payment_method`) VALUES
(1, 1, 4000.00, '2026-06-09', 'Cash'),
(2, 4, 2000.00, '2026-06-11', 'Credit Card');

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `prescription_id` int(11) NOT NULL,
  `record_id` int(11) NOT NULL,
  `medicine_name` varchar(150) NOT NULL,
  `dosage` varchar(50) NOT NULL,
  `frequency` varchar(50) NOT NULL,
  `duration_days` int(11) NOT NULL CHECK (`duration_days` > 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prescription`
--

INSERT INTO `prescription` (`prescription_id`, `record_id`, `medicine_name`, `dosage`, `frequency`, `duration_days`) VALUES
(1, 1, 'Chlorhexidine Mouthwash', '10ml', 'Twice daily', 14),
(2, 2, 'Amoxicillin', '500mg', 'Three times daily', 7),
(3, 2, 'Ibuprofen', '400mg', 'Twice daily', 5),
(4, 4, 'Metronidazole', '400mg', 'Three times daily', 5);

-- --------------------------------------------------------

--
-- Table structure for table `reminder`
--

CREATE TABLE `reminder` (
  `reminder_id` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `reminder_date` date NOT NULL,
  `reminder_type` enum('SMS','Email','Call') NOT NULL,
  `reminder_status` enum('Pending','Sent','Failed') NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reminder`
--

INSERT INTO `reminder` (`reminder_id`, `appointment_id`, `reminder_date`, `reminder_type`, `reminder_status`) VALUES
(1, 1, '2026-06-08', 'SMS', 'Sent'),
(2, 2, '2026-06-08', 'Email', 'Sent'),
(3, 3, '2026-06-09', 'SMS', 'Sent'),
(4, 4, '2026-06-09', 'Call', 'Failed'),
(5, 5, '2026-06-10', 'Email', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `rescheduled`
--

CREATE TABLE `rescheduled` (
  `appointment_id` int(11) NOT NULL,
  `original_date` date NOT NULL,
  `original_time` time NOT NULL,
  `reschedule_reason` text DEFAULT NULL,
  `rescheduled_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rescheduled`
--

INSERT INTO `rescheduled` (`appointment_id`, `original_date`, `original_time`, `reschedule_reason`, `rescheduled_on`) VALUES
(2, '2026-06-07', '10:00:00', 'Patient requested change due to work conflict', '2026-06-06');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `schedule_id` int(11) NOT NULL,
  `dentist_id` int(11) NOT NULL,
  `available_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 1
) ;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`schedule_id`, `dentist_id`, `available_date`, `start_time`, `end_time`, `is_available`) VALUES
(1, 1, '2026-06-09', '09:00:00', '13:00:00', 1),
(2, 1, '2026-06-10', '14:00:00', '18:00:00', 1),
(3, 2, '2026-06-09', '10:00:00', '14:00:00', 1),
(4, 2, '2026-06-11', '09:00:00', '13:00:00', 0),
(5, 3, '2026-06-10', '09:00:00', '17:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `specialization`
--

CREATE TABLE `specialization` (
  `specialization_id` int(11) NOT NULL,
  `specialization_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `specialization`
--

INSERT INTO `specialization` (`specialization_id`, `specialization_name`, `description`) VALUES
(1, 'Orthodontics', 'Diagnosis and treatment of misaligned teeth and jaws'),
(2, 'Endodontics', 'Root canal treatment and diseases of dental pulp'),
(3, 'Periodontics', 'Treatment of gum diseases and supporting structures'),
(4, 'Oral Surgery', 'Surgical procedures including extractions and implants');

-- --------------------------------------------------------

--
-- Table structure for table `treatment`
--

CREATE TABLE `treatment` (
  `treatment_id` int(11) NOT NULL,
  `record_id` int(11) NOT NULL,
  `treatment_name` varchar(150) NOT NULL,
  `treatment_cost` decimal(10,2) NOT NULL CHECK (`treatment_cost` >= 0),
  `treatment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `treatment`
--

INSERT INTO `treatment` (`treatment_id`, `record_id`, `treatment_name`, `treatment_cost`, `treatment_date`) VALUES
(1, 1, 'Scaling and Polishing', 2500.00, '2026-06-09'),
(2, 1, 'Gum Treatment', 1500.00, '2026-06-09'),
(3, 2, 'Root Canal Therapy', 8000.00, '2026-06-09'),
(4, 3, 'Braces Consultation', 1000.00, '2026-06-10'),
(5, 3, 'X-Ray Analysis', 500.00, '2026-06-10'),
(6, 4, 'Tooth Extraction', 3500.00, '2026-06-11');

-- --------------------------------------------------------

--
-- Table structure for table `xray`
--

CREATE TABLE `xray` (
  `xray_id` int(11) NOT NULL,
  `record_id` int(11) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `xray_date` date NOT NULL,
  `xray_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `xray`
--

INSERT INTO `xray` (`xray_id`, `record_id`, `file_path`, `xray_date`, `xray_type`) VALUES
(1, 2, '/xrays/patient2_periapical_20260609.jpg', '2026-06-09', 'Periapical'),
(2, 3, '/xrays/patient3_panoramic_20260610.jpg', '2026-06-10', 'Panoramic'),
(3, 4, '/xrays/patient5_bitewing_20260611.jpg', '2026-06-11', 'Bitewing');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `dentist_id` (`dentist_id`);

--
-- Indexes for table `booked`
--
ALTER TABLE `booked`
  ADD PRIMARY KEY (`appointment_id`),
  ADD UNIQUE KEY `confirmation_no` (`confirmation_no`);

--
-- Indexes for table `cancelled`
--
ALTER TABLE `cancelled`
  ADD PRIMARY KEY (`appointment_id`);

--
-- Indexes for table `dental_record`
--
ALTER TABLE `dental_record`
  ADD PRIMARY KEY (`record_id`),
  ADD UNIQUE KEY `appointment_id` (`appointment_id`);

--
-- Indexes for table `dentist`
--
ALTER TABLE `dentist`
  ADD PRIMARY KEY (`dentist_id`),
  ADD UNIQUE KEY `license_number` (`license_number`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `dentist_specialization`
--
ALTER TABLE `dentist_specialization`
  ADD PRIMARY KEY (`dentist_id`,`specialization_id`),
  ADD KEY `specialization_id` (`specialization_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_id`),
  ADD UNIQUE KEY `record_id` (`record_id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`patient_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `invoice_id` (`invoice_id`);

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`prescription_id`),
  ADD KEY `record_id` (`record_id`);

--
-- Indexes for table `reminder`
--
ALTER TABLE `reminder`
  ADD PRIMARY KEY (`reminder_id`,`appointment_id`),
  ADD KEY `appointment_id` (`appointment_id`);

--
-- Indexes for table `rescheduled`
--
ALTER TABLE `rescheduled`
  ADD PRIMARY KEY (`appointment_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `dentist_id` (`dentist_id`);

--
-- Indexes for table `specialization`
--
ALTER TABLE `specialization`
  ADD PRIMARY KEY (`specialization_id`),
  ADD UNIQUE KEY `specialization_name` (`specialization_name`);

--
-- Indexes for table `treatment`
--
ALTER TABLE `treatment`
  ADD PRIMARY KEY (`treatment_id`),
  ADD KEY `record_id` (`record_id`);

--
-- Indexes for table `xray`
--
ALTER TABLE `xray`
  ADD PRIMARY KEY (`xray_id`),
  ADD KEY `record_id` (`record_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `dental_record`
--
ALTER TABLE `dental_record`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dentist`
--
ALTER TABLE `dentist`
  MODIFY `dentist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `prescription_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reminder`
--
ALTER TABLE `reminder`
  MODIFY `reminder_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `specialization`
--
ALTER TABLE `specialization`
  MODIFY `specialization_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `treatment`
--
ALTER TABLE `treatment`
  MODIFY `treatment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `xray`
--
ALTER TABLE `xray`
  MODIFY `xray_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`),
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`dentist_id`) REFERENCES `dentist` (`dentist_id`);

--
-- Constraints for table `booked`
--
ALTER TABLE `booked`
  ADD CONSTRAINT `booked_ibfk_1` FOREIGN KEY (`appointment_id`) REFERENCES `appointment` (`appointment_id`) ON DELETE CASCADE;

--
-- Constraints for table `cancelled`
--
ALTER TABLE `cancelled`
  ADD CONSTRAINT `cancelled_ibfk_1` FOREIGN KEY (`appointment_id`) REFERENCES `appointment` (`appointment_id`) ON DELETE CASCADE;

--
-- Constraints for table `dental_record`
--
ALTER TABLE `dental_record`
  ADD CONSTRAINT `dental_record_ibfk_1` FOREIGN KEY (`appointment_id`) REFERENCES `appointment` (`appointment_id`);

--
-- Constraints for table `dentist_specialization`
--
ALTER TABLE `dentist_specialization`
  ADD CONSTRAINT `dentist_specialization_ibfk_1` FOREIGN KEY (`dentist_id`) REFERENCES `dentist` (`dentist_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `dentist_specialization_ibfk_2` FOREIGN KEY (`specialization_id`) REFERENCES `specialization` (`specialization_id`) ON DELETE CASCADE;

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`record_id`) REFERENCES `dental_record` (`record_id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`invoice_id`);

--
-- Constraints for table `prescription`
--
ALTER TABLE `prescription`
  ADD CONSTRAINT `prescription_ibfk_1` FOREIGN KEY (`record_id`) REFERENCES `dental_record` (`record_id`) ON DELETE CASCADE;

--
-- Constraints for table `reminder`
--
ALTER TABLE `reminder`
  ADD CONSTRAINT `reminder_ibfk_1` FOREIGN KEY (`appointment_id`) REFERENCES `appointment` (`appointment_id`) ON DELETE CASCADE;

--
-- Constraints for table `rescheduled`
--
ALTER TABLE `rescheduled`
  ADD CONSTRAINT `rescheduled_ibfk_1` FOREIGN KEY (`appointment_id`) REFERENCES `appointment` (`appointment_id`) ON DELETE CASCADE;

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`dentist_id`) REFERENCES `dentist` (`dentist_id`) ON DELETE CASCADE;

--
-- Constraints for table `treatment`
--
ALTER TABLE `treatment`
  ADD CONSTRAINT `treatment_ibfk_1` FOREIGN KEY (`record_id`) REFERENCES `dental_record` (`record_id`) ON DELETE CASCADE;

--
-- Constraints for table `xray`
--
ALTER TABLE `xray`
  ADD CONSTRAINT `xray_ibfk_1` FOREIGN KEY (`record_id`) REFERENCES `dental_record` (`record_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
