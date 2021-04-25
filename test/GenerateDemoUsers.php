<?php

/**
 * Generación de usuarios de demostración.
 * 
 * Los datos de los constructores fueron generados con
 * https://www.generatedata.com/.
 * 
 * Direcciones generadas en http://ensaimeitor.apsl.net/direccion/64/.
 * 
 * Valores de sexo, identidad de género y pronombres generados manualmente.
 */

require_once __DIR__ . '/../config/init.php';

use Juancrrn\Reacsampler\Common\Tools;
use Juancrrn\Reacsampler\Domain\User\LabStaff\LabStaff;
use Juancrrn\Reacsampler\Domain\User\ManagementStaff\ManagementStaff;
use Juancrrn\Reacsampler\Domain\User\MedicalStaff\MedicalStaff;
use Juancrrn\Reacsampler\Domain\User\NursingStaff\NursingStaff;
use Juancrrn\Reacsampler\Domain\User\Patient\Patient;
use Juancrrn\Reacsampler\Domain\User\User;

function govIdComplete(int $nif) {
	return $nif . substr('TRWAGMYFPDXBNJZSQVHLCKEO', $nif % 23, 1);
}

function demoEmailFromNames(string $first_name, string $last_name): string
{
	$last_name_explode = explode(' ', $last_name);
	$email_address = mb_strtolower($first_name);

	foreach ($last_name_explode as $word) {
		$email_address .= mb_strtolower($word[0]);
	}

	$email_address .= '@invalid.email';

	return $email_address;
}

function demoCollegiateNumber(): string
{
	$id = '';

    for($i = 0; $i < 4; $i++) {
        $id .= mt_rand(0, 9);
    }

	return 'CAM-' . $id;
}

function demoCode(): string
{
	$id = '';

    for($i = 0; $i < 12; $i++) {
        $id .= mt_rand(0, 9);
    }

	return 'CAM-' . $id;
}

function factoryCreator($id, $gov_id, $type, $first_name, $last_name, $phone_number, $birth_date, $creation_date, $last_login_date)
{
	switch ($type) {
		case User::TYPE_LAB_STAFF:
			return new LabStaff(
				$id,
				govIdComplete($gov_id),
				User::TYPE_LAB_STAFF,
				$first_name,
				$last_name,
				$phone_number,
				demoEmailFromNames($first_name, $last_name),
				DateTime::createFromFormat(Tools::MYSQL_DATE_FORMAT, $birth_date),
				DateTime::createFromFormat(Tools::MYSQL_DATETIME_FORMAT, $creation_date),
				DateTime::createFromFormat(Tools::MYSQL_DATETIME_FORMAT, $last_login_date),
				'Tecnología de laboratorio',
				demoCollegiateNumber()
			);
			break;
		case User::TYPE_MANAGEMENT_STAFF:
			return new ManagementStaff(
				$id,
				govIdComplete($gov_id),
				User::TYPE_LAB_STAFF,
				$first_name,
				$last_name,
				$phone_number,
				demoEmailFromNames($first_name, $last_name),
				DateTime::createFromFormat(Tools::MYSQL_DATE_FORMAT, $birth_date),
				DateTime::createFromFormat(Tools::MYSQL_DATETIME_FORMAT, $creation_date),
				DateTime::createFromFormat(Tools::MYSQL_DATETIME_FORMAT, $last_login_date),
				'Administración'
			);
			break;
		case User::TYPE_MEDICAL_STAFF:
			return new MedicalStaff(
				$id,
				govIdComplete($gov_id),
				User::TYPE_LAB_STAFF,
				$first_name,
				$last_name,
				$phone_number,
				demoEmailFromNames($first_name, $last_name),
				DateTime::createFromFormat(Tools::MYSQL_DATE_FORMAT, $birth_date),
				DateTime::createFromFormat(Tools::MYSQL_DATETIME_FORMAT, $creation_date),
				DateTime::createFromFormat(Tools::MYSQL_DATETIME_FORMAT, $last_login_date),
				'Medicina general y de familia',
				demoCollegiateNumber()
			);
			break;
		case User::TYPE_NURSING_STAFF:
			return new NursingStaff(
				$id,
				govIdComplete($gov_id),
				User::TYPE_LAB_STAFF,
				$first_name,
				$last_name,
				$phone_number,
				demoEmailFromNames($first_name, $last_name),
				DateTime::createFromFormat(Tools::MYSQL_DATE_FORMAT, $birth_date),
				DateTime::createFromFormat(Tools::MYSQL_DATETIME_FORMAT, $creation_date),
				DateTime::createFromFormat(Tools::MYSQL_DATETIME_FORMAT, $last_login_date),
				'Enfermería general',
				demoCollegiateNumber()
			);
			break;
		case User::TYPE_PATIENT:
			return new Patient(
				$id,
				govIdComplete($gov_id),
				User::TYPE_LAB_STAFF,
				$first_name,
				$last_name,
				$phone_number,
				demoEmailFromNames($first_name, $last_name),
				DateTime::createFromFormat(Tools::MYSQL_DATE_FORMAT, $birth_date),
				DateTime::createFromFormat(Tools::MYSQL_DATETIME_FORMAT, $creation_date),
				DateTime::createFromFormat(Tools::MYSQL_DATETIME_FORMAT, $last_login_date),
				'FILL_LATER_POSTAL_ADDRESS',//$postalAddress,
				demoCode(),
				demoCode(),
				'FILL_LATER_SEX',//$sex,
				'FILL_LATER_GENDER_IDENTITY',//$genderIdentity,
				'FILL_LATER_PRONOUNS'//$pronouns
			);
			break;
		default:
			throw new OutOfBoundsException('User type is not valid.');
	}
}

$demoLabStaff = array(
	factoryCreator(1, 59513266, User::TYPE_LAB_STAFF, "Harlan", "Olson Mcclure", "+34 252 394 703", "1974-06-23", "2021-02-25 12:00:00", "2021-03-19 21:06:35"),
	factoryCreator(2, 30534312, User::TYPE_LAB_STAFF, "Holmes", "Barry Crawford", "+34 371 282 673", "1981-06-02", "2021-02-25 12:00:00", "2021-03-11 19:17:05"),
	factoryCreator(3, 74791232, User::TYPE_LAB_STAFF, "Ima", "Woods Mcdonald", "+34 353 116 633", "1998-12-13", "2021-02-25 12:00:00", "2021-04-16 08:08:02"),
	factoryCreator(4, 83966445, User::TYPE_LAB_STAFF, "Macey", "Salazar Holmes", "+34 544 244 006", "1971-05-18", "2021-02-25 12:00:00", "2021-03-22 09:50:34")
);

$demoManagementStaff = array(
	factoryCreator(5, 12492613, User::TYPE_MANAGEMENT_STAFF, "Stella", "Vaughn Bush", "+34 979 787 866", "1988-12-12", "2021-02-25 12:00:00", "2021-03-28 22:55:56"),
	factoryCreator(6, 64548526, User::TYPE_MANAGEMENT_STAFF, "Melanie", "Martin Mcguire", "+34 457 543 114", "1982-12-28", "2021-02-25 12:00:00", "2021-03-29 23:54:40")
);

$demoMedicalStaff = array(
	factoryCreator(7, 98189148, User::TYPE_MEDICAL_STAFF, "Quinn", "Harper Stevenson", "+34 427 015 693", "1969-09-17", "2021-02-25 12:00:00", "2021-04-04 14:53:39"),
	factoryCreator(8, 50825476, User::TYPE_MEDICAL_STAFF, "Nissim", "Chan Hutchinson", "+34 931 875 334", "1961-12-08", "2021-02-25 12:00:00", "2021-04-07 04:30:36"),
	factoryCreator(9, 49327270, User::TYPE_MEDICAL_STAFF, "Berk", "Casey Stewart", "+34 332 651 431", "1968-04-05", "2021-02-25 12:00:00", "2021-03-25 21:30:04")
);

$demoNursingStaff = array(
	factoryCreator(10, 87553759, User::TYPE_NURSING_STAFF, "Rhea", "Chavez Cherry", "+34 578 784 916", "1968-06-20", "2021-02-25 12:00:00", "2021-04-13 06:40:31"),
	factoryCreator(11, 45046917, User::TYPE_NURSING_STAFF, "Indigo", "Monroe Stone", "+34 728 516 296", "1998-05-03", "2021-02-25 12:00:00", "2021-04-10 11:40:05"),
	factoryCreator(12, 46817193, User::TYPE_NURSING_STAFF, "Calvin", "Ortega Mcclain", "+34 692 531 973", "1996-01-15", "2021-02-25 12:00:00", "2021-04-08 18:40:41")
);

$demoPatient = array(
	factoryCreator(13, 10048355, User::TYPE_PATIENT, "Carly", "Castillo Finley", "+34 525 754 5","1960-10-05", "2021-02-25 12:00:00", "2021-04-06 13:09:27"),
	factoryCreator(14, 23214884, User::TYPE_PATIENT, "Byron", "Moore Walters", "+34 511 500 7","1965-08-12", "2021-02-25 12:00:00", "2021-03-07 04:15:52"),
	factoryCreator(15, 57369060, User::TYPE_PATIENT, "Lacota", "Holloway Munoz", "+34 812 952 0","1965-08-03", "2021-02-25 12:00:00", "2021-03-18 18:54:37"),
	factoryCreator(16, 72708707, User::TYPE_PATIENT, "Kimberly", "Hartman Bonner", "+34 462 915 9","1992-05-20", "2021-02-25 12:00:00", "2021-03-10 18:35:19"),
	factoryCreator(17, 74730352, User::TYPE_PATIENT, "Jerome", "Cummings Conrad", "+34 771 044 6","1958-05-31", "2021-02-25 12:00:00", "2021-04-04 16:28:53"),
	factoryCreator(18, 84588666, User::TYPE_PATIENT, "Nasim", "Douglas Emerson", "+34 612 898 2","1963-07-10", "2021-02-25 12:00:00", "2021-03-10 00:17:59"),
	factoryCreator(19, 43735386, User::TYPE_PATIENT, "Amal", "Jacobson Finley", "+34 600 719 2","1999-06-25", "2021-02-25 12:00:00", "2021-04-04 22:10:07"),
	factoryCreator(20, 81046620, User::TYPE_PATIENT, "Plato", "Mercado Howe", "+34 191 563 2","1973-12-04", "2021-02-25 12:00:00", "2021-04-10 12:42:54"),
	factoryCreator(21, 34739168, User::TYPE_PATIENT, "Tatum", "Harrell Howe", "+34 139 018 6","1975-11-22", "2021-02-25 12:00:00", "2021-03-04 04:37:13"),
	factoryCreator(22, 29422946, User::TYPE_PATIENT, "Joshua", "Woodward Paul", "+34 395 161 2","1961-08-18", "2021-02-25 12:00:00", "2021-03-10 22:48:26"),
	factoryCreator(23, 92280745, User::TYPE_PATIENT, "Hanna", "Macdonald Chavez", "+34 492 924 3","1992-01-18", "2021-02-25 12:00:00", "2021-03-25 19:57:24"),
	factoryCreator(24, 19451399, User::TYPE_PATIENT, "Lacey", "Sykes Vang", "+34 878 239 1","1972-02-24", "2021-02-25 12:00:00", "2021-04-08 23:22:43"),
	factoryCreator(25, 96671516, User::TYPE_PATIENT, "Kirk", "Knowles Bond", "+34 399 002 0","1989-06-25", "2021-02-25 12:00:00", "2021-02-27 12:55:39"),
	factoryCreator(26, 36382548, User::TYPE_PATIENT, "Idola", "Gonzales Puckett", "+34 367 085 2","1984-11-16", "2021-02-25 12:00:00", "2021-03-26 21:38:31"),
	factoryCreator(27, 49111372, User::TYPE_PATIENT, "Raphael", "Christian Olson", "+34 669 575 5","1999-11-24", "2021-02-25 12:00:00", "2021-04-07 07:02:54"),
	factoryCreator(28, 64840653, User::TYPE_PATIENT, "Octavia", "Wilkins Briggs", "+34 521 338 5","1974-10-05", "2021-02-25 12:00:00", "2021-03-03 13:57:59"),
	factoryCreator(29, 43975350, User::TYPE_PATIENT, "Jarrod", "Boyd Dawson", "+34 307 878 3","1995-04-11", "2021-02-25 12:00:00", "2021-03-07 15:52:19"),
	factoryCreator(30, 54541496, User::TYPE_PATIENT, "Arthur", "Whitehead Best", "+34 427 481 0","1991-01-29", "2021-02-25 12:00:00", "2021-04-10 22:40:19"),
	factoryCreator(31, 21498126, User::TYPE_PATIENT, "Alfonso", "Ramos Dotson", "+34 855 773 6","1958-04-24", "2021-02-25 12:00:00", "2021-03-29 11:56:31"),
	factoryCreator(32, 98967433, User::TYPE_PATIENT, "Jaden", "Griffin Chapman", "+34 288 642 2","1982-08-20", "2021-02-25 12:00:00", "2021-03-09 11:46:54"),
	factoryCreator(33, 74685070, User::TYPE_PATIENT, "Felicia", "Gardner Mckay", "+34 338 953 1","1967-03-25", "2021-02-25 12:00:00", "2021-03-25 18:44:57"),
	factoryCreator(34, 12737637, User::TYPE_PATIENT, "Otto", "Wooten Phillips", "+34 854 347 6","1995-10-06", "2021-02-25 12:00:00", "2021-03-06 09:53:23"),
	factoryCreator(35, 42061404, User::TYPE_PATIENT, "Berk", "Britt Frye", "+34 645 858 6","1959-01-17", "2021-02-25 12:00:00", "2021-02-26 18:46:32"),
	factoryCreator(36, 15827735, User::TYPE_PATIENT, "Darryl", "Glover Velez", "+34 566 423 3","1981-08-07", "2021-02-25 12:00:00", "2021-03-06 18:58:35"),
	factoryCreator(37, 31559100, User::TYPE_PATIENT, "Jared", "Dodson York", "+34 699 413 6","1971-08-15", "2021-02-25 12:00:00", "2021-04-14 00:40:03"),
	factoryCreator(38, 12883780, User::TYPE_PATIENT, "Glenna", "French Dotson", "+34 129 104 1","1990-10-01", "2021-02-25 12:00:00", "2021-03-05 23:54:11"),
	factoryCreator(39, 81873927, User::TYPE_PATIENT, "Shaine", "Martinez Kelly", "+34 274 588 0","1985-12-06", "2021-02-25 12:00:00", "2021-04-03 15:09:56"),
	factoryCreator(40, 74831748, User::TYPE_PATIENT, "Asher", "Blake Doyle", "+34 372 614 2","1968-09-28", "2021-02-25 12:00:00", "2021-03-14 11:45:58"),
	factoryCreator(41, 54309627, User::TYPE_PATIENT, "Cameron", "Bush Norris", "+34 876 135 3","1985-07-24", "2021-02-25 12:00:00", "2021-04-03 18:27:53"),
	factoryCreator(42, 36486555, User::TYPE_PATIENT, "Emerald", "Davenport Monroe", "+34 987 719 1","1965-06-08", "2021-02-25 12:00:00", "2021-04-01 07:45:28"),
	factoryCreator(43, 62867128, User::TYPE_PATIENT, "Zachary", "Keith Scott", "+34 733 891 3","1974-07-07", "2021-02-25 12:00:00", "2021-03-22 22:14:08"),
	factoryCreator(44, 51005362, User::TYPE_PATIENT, "Mira", "Wall Moran", "+34 473 142 3","1966-06-13", "2021-02-25 12:00:00", "2021-04-10 11:36:10"),
	factoryCreator(45, 79957735, User::TYPE_PATIENT, "Lara", "Cote Melendez", "+34 538 447 6","1995-12-12", "2021-02-25 12:00:00", "2021-04-15 14:53:52"),
	factoryCreator(46, 83478203, User::TYPE_PATIENT, "Paula", "Ellison Craig", "+34 901 079 3","1997-03-18", "2021-02-25 12:00:00", "2021-02-26 05:59:50"),
	factoryCreator(47, 32980190, User::TYPE_PATIENT, "Duncan", "Dorsey Mullen", "+34 796 185 8","1959-04-16", "2021-02-25 12:00:00", "2021-03-31 10:07:33"),
	factoryCreator(48, 54889769, User::TYPE_PATIENT, "Simon", "Burke Mooney", "+34 527 479 3","1995-03-20", "2021-02-25 12:00:00", "2021-04-19 11:37:37"),
	factoryCreator(49, 62932842, User::TYPE_PATIENT, "Maggy", "Kent Pate", "+34 501 861 3","1991-01-23", "2021-02-25 12:00:00", "2021-04-11 22:38:03"),
	factoryCreator(50, 52715242, User::TYPE_PATIENT, "Malachi", "Guy Walters", "+34 853 943 8","1966-05-17", "2021-02-25 12:00:00", "2021-04-15 12:17:23"),
	factoryCreator(51, 83323055, User::TYPE_PATIENT, "Daria", "Flowers Nichols", "+34 523 518 2","1986-09-21", "2021-02-25 12:00:00", "2021-03-07 07:35:43"),
	factoryCreator(52, 58543694, User::TYPE_PATIENT, "Daphne", "Marshall Bolton", "+34 240 679 2","1979-07-04", "2021-02-25 12:00:00", "2021-04-02 12:57:52"),
	factoryCreator(53, 92168015, User::TYPE_PATIENT, "Elizabeth", "Gordon Cochran", "+34 806 560 1","1994-09-18", "2021-02-25 12:00:00", "2021-03-16 04:39:37"),
	factoryCreator(54, 68577031, User::TYPE_PATIENT, "Lani", "Tran Kemp", "+34 221 436 3","1996-02-25", "2021-02-25 12:00:00", "2021-03-27 01:04:20"),
	factoryCreator(55, 68552894, User::TYPE_PATIENT, "Macaulay", "Aguilar Horne", "+34 311 107 5","1988-07-14", "2021-02-25 12:00:00", "2021-02-26 23:07:51"),
	factoryCreator(56, 75594348, User::TYPE_PATIENT, "Griffith", "Workman Faulkner", "+34 248 954 1","1982-07-22", "2021-02-25 12:00:00", "2021-03-31 02:35:33"),
	factoryCreator(57, 26916797, User::TYPE_PATIENT, "Kristen", "Moore Spence", "+34 185 197 4","1979-01-24", "2021-02-25 12:00:00", "2021-04-10 18:49:34"),
	factoryCreator(58, 34237360, User::TYPE_PATIENT, "Kameko", "Sharpe Robles", "+34 447 154 2","1991-12-10", "2021-02-25 12:00:00", "2021-03-04 17:00:59"),
	factoryCreator(59, 90345907, User::TYPE_PATIENT, "Marah", "Ochoa Blair", "+34 278 357 9","1983-12-18", "2021-02-25 12:00:00", "2021-04-01 04:35:28"),
	factoryCreator(60, 31850744, User::TYPE_PATIENT, "Paki", "Barlow Bell", "+34 682 915 5","1975-05-27", "2021-02-25 12:00:00", "2021-03-13 00:35:03"),
	factoryCreator(61, 57300582, User::TYPE_PATIENT, "Madison", "Mcmahon Blake", "+34 440 133 5","1993-04-06", "2021-02-25 12:00:00", "2021-03-20 12:03:21"),
	factoryCreator(62, 66803344, User::TYPE_PATIENT, "Adria", "Lopez Gordon", "+34 522 717 8","1972-04-07", "2021-02-25 12:00:00", "2021-04-16 10:49:39"),
	factoryCreator(63, 34765089, User::TYPE_PATIENT, "Kimberley", "Poole Tyson", "+34 731 799 5","1968-09-23", "2021-02-25 12:00:00", "2021-04-18 10:36:14"),
	factoryCreator(64, 82496829, User::TYPE_PATIENT, "Camilla", "Rowland Young", "+34 683 393 4","1962-10-12", "2021-02-25 12:00:00", "2021-03-26 13:50:53"),
	factoryCreator(65, 61242073, User::TYPE_PATIENT, "Ivor", "Mcclure Benjamin", "+34 669 009 8","1961-11-27", "2021-02-25 12:00:00", "2021-04-13 09:08:32"),
	factoryCreator(66, 58987000, User::TYPE_PATIENT, "Rafael", "Myers Hogan", "+34 135 173 4","1968-05-01", "2021-02-25 12:00:00", "2021-03-27 10:31:46"),
	factoryCreator(67, 12923892, User::TYPE_PATIENT, "MacKensie", "England Cobb", "+34 426 682 2","1981-12-27", "2021-02-25 12:00:00", "2021-03-28 08:09:10"),
	factoryCreator(68, 92462125, User::TYPE_PATIENT, "Hammett", "Hahn Branch", "+34 505 329 1","1974-12-07", "2021-02-25 12:00:00", "2021-03-22 17:48:59"),
	factoryCreator(69, 53870416, User::TYPE_PATIENT, "Flavia", "Kent Mckinney", "+34 767 625 5","1975-01-30", "2021-02-25 12:00:00", "2021-03-11 08:58:39"),
	factoryCreator(70, 94919273, User::TYPE_PATIENT, "Freya", "Head Wells", "+34 267 824 2","1969-08-06", "2021-02-25 12:00:00", "2021-04-11 07:44:40"),
	factoryCreator(71, 11418748, User::TYPE_PATIENT, "Abel", "Gamble Armstrong", "+34 840 185 3","1968-05-29", "2021-02-25 12:00:00", "2021-03-05 22:46:49"),
	factoryCreator(72, 88825346, User::TYPE_PATIENT, "Zeph", "West Elliott", "+34 890 697 2","1974-01-02", "2021-02-25 12:00:00", "2021-04-09 06:22:23"),
	factoryCreator(73, 94318775, User::TYPE_PATIENT, "Brielle", "Reeves Olson", "+34 426 558 0","1965-04-24", "2021-02-25 12:00:00", "2021-04-08 16:49:04"),
	factoryCreator(74, 42517428, User::TYPE_PATIENT, "Hiram", "Knowles Chen", "+34 965 616 0","1969-06-13", "2021-02-25 12:00:00", "2021-04-22 10:55:53"),
	factoryCreator(75, 68015107, User::TYPE_PATIENT, "Grant", "Sandoval Mooney", "+34 276 689 6","1970-11-14", "2021-02-25 12:00:00", "2021-03-26 05:01:50"),
	factoryCreator(76, 58369052, User::TYPE_PATIENT, "Mercedes", "Mclaughlin Cain", "+34 926 606 6","1963-11-22", "2021-02-25 12:00:00", "2021-03-19 14:07:42")
);

function printAsMySQLInsert(array $users): void
{
	foreach ($users as $user) {
		echo "INSERT INTO `users` (`id`, `gov_id`, `type`, `first_name`, `last_name`, `phone_number`, `email_address`, `hashed_password`, `birth_date`, `registration_date`, `last_login_date`) VALUES (" .
			$user->getId() . ", '" .
			$user->getGovId() . "', '" .
			$user->getType() . "', '" .
			$user->getFirstName() . "', '" .
			$user->getLastName() . "', '" .
			$user->getPhoneNumber() . "', '" .
			$user->getEmailAddress() . "', '" . 
			password_hash("holamundo", PASSWORD_DEFAULT) . "', '" .
			$user->getBirthDate()->format(Tools::MYSQL_DATE_FORMAT) . "','" .
			$user->getRegistrationDate()->format(Tools::MYSQL_DATETIME_FORMAT) . "','" .
			$user->getLastLoginDate()->format(Tools::MYSQL_DATETIME_FORMAT) . "');\n";

		$class = get_class($user);

		switch ($class) {
			case LabStaff::class:
				echo "INSERT INTO `users_type_lab` (`id`, `field`, `collegiate_number`) VALUES (" .
					$user->getId() . ", '" . 
					$user->getField() . "', '" . 
					$user->getCollegiateNumber() . "'" .
				");\n";
				break;
			case ManagementStaff::class:
				echo "INSERT INTO `users_type_management` (`id`, `area`) VALUES (" .
					$user->getId() . ", '" . 
					$user->getArea() . "'" .
				");\n";
				break;
			case MedicalStaff::class:
				echo "INSERT INTO `users_type_medical` (`id`, `field`, `collegiate_number`) VALUES (" .
					$user->getId() . ", '" . 
					$user->getField() . "', '" . 
					$user->getCollegiateNumber() . "'" .
				");\n";
				break;
			case NursingStaff::class:
				echo "INSERT INTO `users_type_nursing` (`id`, `field`, `collegiate_number`) VALUES (" .
					$user->getId() . ", '" . 
					$user->getField() . "', '" . 
					$user->getCollegiateNumber() . "'" .
				");\n";
				break;
			case Patient::class:
				echo "INSERT INTO `users_type_patient` (`id`, `postal_address`, `cipa_code`, `csns_code`, `sex`, `gender_identity`, `pronouns`) VALUES (" .
					$user->getId() . ", '" . 
					$user->getPostalAddress() . "', '" . 
					$user->getCipaCode() . "', '" . 
					$user->getCsnsCode() . "', '" . 
					$user->getSex() . "', '" . 
					$user->getGenderIdentity() . "', '" . 
					$user->getPronouns() . "'" .
				");\n";
				break;
			default:
				throw new OutOfBoundsException('User type is not valid.');
		}
	}
}

printAsMySQLInsert(array_merge(
	$demoLabStaff,
	$demoManagementStaff,
	$demoMedicalStaff,
	$demoNursingStaff,
	$demoPatient
));

?>