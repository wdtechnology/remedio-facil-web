drop database remedio_facil;

create database remedio_facil;

use remedio_facil;

create table cadastro (
    `cadastro_id` integer not null auto_increment primary key,
    `cadastro_nome` varchar(100) not null,
    `cadastro_email` varchar(100) not null,
    `cadastro_cnpj` varchar(14) not null,
    `cadastro_access` varchar(255) not null,
    `cadastro_status` tinyint not null DEFAULT '0',
    `cadastro_confirm` tinyint not null DEFAULT '0',
    `cadastro_create` datetime not null,
    `cadastro_update` datetime null
)engine=innodb, charset=utf8;


INSERT INTO `cadastro` (`cadastro_id`, `cadastro_nome`, `cadastro_status`, `cadastro_confirm`, `cadastro_email`, `cadastro_cnpj`, `cadastro_create`, `cadastro_update`) VALUES
(1, 'Remédio Fácil', 1,1, 'suporteremediofacil@gmail.com', '12121212121212',NOW(), NULL);


create table farmacia (
    `farmacia_id` integer NOT NULL auto_increment primary key ,
    `farmacia_nome` varchar(100) NOT NULL,
    `farmacia_login` varchar(100) NOT NULL,
    `farmacia_senha` varchar(255) NOT NULL,
    `farmacia_cnpj` integer NOT NULL,
    `farmacia_cep` varchar(10) NOT NULL,
    `farmacia_cidade` varchar(50) NOT NULL,
    `farmacia_bairro` varchar(50) NOT NULL,
    `farmacia_rua` varchar(150) NOT NULL,
    `farmacia_uf` char(2) NOT NULL,
    `farmacia_status` tinyint(1) NOT NULL DEFAULT '0',
    `farmacia_permission` tinyint(1) NOT NULL DEFAULT '0',
    `farmacia_reset` varchar(5) null,
    `farmacia_access` varchar(255) null,
    `farmacia_token` varchar(32) NULL,
    `farmacia_create` datetime NOT NULL,
    `farmacia_update` datetime NULL,
    `farmacia_delete` datetime NULL,
    FOREIGN KEY(`farmacia_cnpj`) references cadastro(`cadastro_id`)
)engine=innodb, charset=utf8;


INSERT INTO `farmacia` (`farmacia_id`, `farmacia_nome`, `farmacia_login`, `farmacia_senha`, `farmacia_cnpj`, `farmacia_cep`, `farmacia_cidade`, `farmacia_bairro`, `farmacia_rua`, `farmacia_uf`, `farmacia_status`, `farmacia_permission`, `farmacia_token`, `farmacia_create`, `farmacia_update`, `farmacia_delete`) VALUES
(1, 'Administrador', 'suporteremediofacil@gmail.com', '$2y$10$MkK.tXXGOCJRI1rWHhpm8uzMakzpxmZAJdM7.Mar6V.w2i3tq.1w2', 1, '09381100', 'Mauá', 'Jardim Oratório', 'Rua Maceió', 'SP', 1, 1, NULL, NOW(), NULL, NULL);


create table posto (
    `posto_id` integer not null auto_increment primary key,
    `posto_farmacia` integer not null,
    `posto_create` datetime not null,
    `posto_update` datetime null,
    FOREIGN KEY(`posto_farmacia`) references farmacia(`farmacia_id`)
)engine=innodb, charset=utf8;


create table remedio (
    `remedio_id` integer not null auto_increment primary key,
    `remedio_nome` varchar(255) not null,
    `remedio_create` datetime not null,
    `remedio_update` datetime null
)engine=innodb, charset=utf8;

INSERT INTO `remedio` (`remedio_id`, `remedio_nome`, `remedio_create`, `remedio_update`) VALUES
(1, 'aciclovir 200 mg comprimido', '2019-11-24 14:44:39', NULL),
(2, 'Ã¡cido acetilsalicÃ­lico 100 mg comprimido', '2019-11-24 14:44:58', NULL),
(3, 'Ã¡cido fÃ³lico 0,2 mg/mL soluÃ§Ã£o oral (gotas) frasco', '2019-11-24 14:45:07', NULL),
(4, 'Ã¡cido fÃ³lico 5 mg comprimido', '2019-11-24 14:45:24', NULL),
(5, 'albendazol 40 mg/mL suspensÃ£o oral frasco', '2019-11-24 14:57:25', NULL),
(6, 'albendazol 400 mg comprimido mastigÃ¡vel', '2019-11-24 14:57:34', NULL),
(7, 'alopurinol 100 mg comprimido', '2019-11-24 14:57:42', NULL),
(8, 'amiodarona, cloridrato 200 mg comprimido', '2019-11-24 14:57:51', NULL),
(9, 'amitriptilina, cloridrato 25 mg comprimido', '2019-11-24 14:57:58', NULL),
(10, 'amitriptilina, cloridrato 75 mg comprimido', '2019-11-24 14:58:06', NULL),
(11, 'amoxicilina 50 mg/mL pÃ³ para suspensÃ£o oral frasco', '2019-11-24 14:58:17', NULL),
(12, 'amoxicilina 500 mg comprimido', '2019-11-24 14:58:25', NULL),
(13, 'anlodipino, besilato 10 mg comprimido', '2019-11-24 14:58:35', NULL),
(14, 'anlodipino, besilato 5 mg comprimido', '2019-11-24 14:58:43', NULL),
(15, 'atenolol 50 mg comprimido', '2019-11-24 14:58:52', NULL),
(16, 'azitromicina 40 mg/mL suspensÃ£o oral frasco', '2019-11-24 14:59:07', NULL),
(17, 'azitromicina 500 mg comprimido', '2019-11-24 14:59:24', NULL),
(18, 'beclometasona, dipropionato 250 Î¼g/dose pÃ³ para soluÃ§Ã£o inalante ou aerossol oral frasco', '2019-11-24 14:59:34', NULL),
(19, 'beclometasona, dipropionato 50 Âµg /dose pÃ³ para soluÃ§Ã£o inalante ou aerossol oral frasco', '2019-11-24 14:59:43', NULL),
(20, 'beclometasona, dipropionato 50 Î¼g/dose (equivalente a 42 Î¼g de beclometasona/dose) aerossol nasal frasco', '2019-11-24 14:59:52', NULL),
(21, 'benzilpenicilina procaÃ­na 300.000 UI + benzilpenicilina potÃ¡ssica 100.000 UI suspensÃ£o injetÃ¡vel fr-amp', '2019-11-24 15:00:02', NULL),
(22, 'benzilpenicilina benzatina 1.200.000 UI pÃ³ para suspensÃ£o injetÃ¡vel framp', '2019-11-24 15:00:18', NULL),
(23, 'benzilpenicilina benzatina 600.000 UI pÃ³ para suspensÃ£o injetÃ¡vel framp', '2019-11-24 15:00:29', NULL),
(24, 'benzoilmetronidazol 40 mg/mL suspensÃ£o oral frasco', '2019-11-24 15:01:05', NULL),
(25, 'biperideno, cloridrato 2 mg comprimido', '2019-11-24 15:01:13', NULL),
(26, 'brimonidina 2 mg/mL (0,2%)soluÃ§Ã£o oftÃ¡lmica frasco', '2019-11-24 15:01:22', NULL),
(27, 'captopril 25 mg comprimido', '2019-11-24 15:01:30', NULL),
(28, 'carbamazepina 20 mg/mL (2%) suspensÃ£o oral frasco', '2019-11-24 15:01:38', NULL),
(29, 'carbamazepina 200 mg comprimido', '2019-11-24 15:01:45', NULL),
(30, 'carbamazepina 400 mg comprimido', '2019-11-24 15:01:57', NULL),
(31, 'carbonato de cÃ¡lcio 500 mg comprimido', '2019-11-24 15:02:05', NULL),
(32, 'carbonato de lÃ­tio 300 mg comprimido', '2019-11-24 15:02:13', NULL),
(33, 'carvedilol 12,5 mg comprimido', '2019-11-24 15:02:21', NULL),
(34, 'carvedilol 6,25 mg comprimido', '2019-11-24 15:03:09', NULL),
(35, 'cefalexina 50 mg/mL suspensÃ£o oral frasco', '2019-11-24 15:03:16', NULL),
(36, 'cefalexina comprimido 500 mg', '2019-11-24 15:03:23', NULL),
(37, 'cetoconazol 20 mg/g (2%) creme bisnaga', '2019-11-24 15:03:30', NULL),
(38, 'cianocobalamina (vit. B12) 2,5 mg/mL (2.500 Âµg) soluÃ§Ã£o injetÃ¡vel amp. 2 mL', '2019-11-24 15:03:38', NULL),
(39, 'ciprofloxacino, cloridrato 500 mg comprimido', '2019-11-24 15:03:45', NULL),
(40, 'claritromicina 50 mg/mL pÃ³ para suspensÃ£o oral frasco', '2019-11-24 15:03:53', NULL),
(41, 'claritromicina 500 mg comprimido de aÃ§Ã£o prolongada', '2019-11-24 15:04:02', NULL),
(42, 'clindamicina, cloridrato 300 mg cÃ¡psula', '2019-11-24 15:04:09', NULL),
(43, 'clomipramina, cloridrato 25 mg comprimido', '2019-11-24 15:04:15', NULL),
(44, 'clonazepam 0,5 mg comprimido', '2019-11-24 15:04:22', NULL),
(45, 'clonazepam 2 mg comprimido', '2019-11-24 15:04:30', NULL),
(46, 'clonazepam 2,5 mg/mL (0,25%) soluÃ§Ã£o oral gotas frasco', '2019-11-24 15:04:38', NULL),
(47, 'cloranfenicol 5 mg/g + retinol, acetato 10.000 UI/g + aminoÃ¡cidos 25 mg/g + metionina 5 mg/g pomada oftÃ¡lmica bisnaga', '2019-11-24 15:04:45', NULL),
(48, 'cloreto de sÃ³dio 9 mg/mL (0,9 % - 0,154 mEq/mL) soluÃ§Ã£o injetÃ¡vel amp. 10 mL', '2019-11-24 15:04:52', NULL),
(49, 'cloreto de sÃ³dio 9 mg/mL (0,9%) soluÃ§Ã£o nasal (gotas) frasco', '2019-11-24 15:05:09', NULL),
(50, 'clorpromazina, cloridrato 100 mg comprimido', '2019-11-24 15:05:15', NULL),
(51, 'clorpromazina, cloridrato 25 mg comprimido', '2019-11-24 15:05:22', NULL),
(52, 'clorpromazina, cloridrato 40 mg/mL (4%) soluÃ§Ã£o oral (gotas) frasco', '2019-11-24 15:05:29', NULL),
(53, 'dalteparina sÃ³dica 2.500 UI (12.500 UI/ml) subcutÃ¢nea seringa 0,2 ml', '2019-11-24 15:05:37', NULL),
(54, 'dalteparina sÃ³dica 5.000 UI (25.000 UI/ml) subcutÃ¢nea seringa 0,2 ml', '2019-11-24 15:05:43', NULL),
(55, 'dexametasona 0,1 mg/mL soluÃ§Ã£o oral frasco', '2019-11-24 15:05:50', NULL),
(56, 'dexametasona 1 mg/g (0,1%) creme bisnaga', '2019-11-24 15:05:57', NULL),
(57, 'dexametasona 1 mg/mL (0,1%) soluÃ§Ã£o oftÃ¡lmica frasco', '2019-11-24 15:06:04', NULL),
(58, 'dexclorfeniramina, maleato 0,4 mg/mL soluÃ§Ã£o oral frasco', '2019-11-24 15:06:12', NULL),
(59, 'diazepam 5 mg comprimido', '2019-11-24 15:06:19', NULL),
(60, 'diclofenaco 50 mg comprimido', '2019-11-24 15:06:25', NULL),
(61, 'digoxina 0,25 mg comprimido', '2019-11-24 15:06:34', NULL),
(62, 'dimenidrinato 25 mg/mL + piridoxina, cloridrato (vit. B6) 5 mg/mL soluÃ§Ã£o oral gotas frasco', '2019-11-24 15:06:41', NULL),
(63, 'dipirona sÃ³dica 500 mg comprimido', '2019-11-24 15:06:47', NULL),
(64, 'dipirona sÃ³dica 500 mg/mL soluÃ§Ã£o oral gotas frasco', '2019-11-24 15:06:54', NULL),
(65, 'doxazosina 2 mg comprimido', '2019-11-24 15:06:59', NULL),
(66, 'doxiciclina, cloridrato 100 mg comprimido', '2019-11-24 15:07:09', NULL),
(67, 'enalapril, maleato 20 mg comprimido', '2019-11-24 15:07:15', NULL),
(68, 'enalapril, maleato 5 mg comprimido', '2019-11-24 15:07:22', NULL),
(69, 'enoxaparina sÃ³dica 20 mg (equivalente a 100 mg/mL) soluÃ§Ã£o injetÃ¡vel seringa 0,2 mL SC', '2019-11-24 15:08:41', NULL),
(70, 'enoxaparina sÃ³dica 40 mg (equivalente a 100 mg/mL) soluÃ§Ã£o injetÃ¡vel seringa 0,4 mL SC', '2019-11-24 15:08:57', NULL),
(71, 'enoxaparina sÃ³dica 60 mg (equivalente a 100 mg/mL) soluÃ§Ã£o injetÃ¡vel seringa 0,6 mL SC', '2019-11-24 15:09:04', NULL),
(72, 'espiramicina 500 mg (equivalente a 1.500.000 UI) comprimido', '2019-11-24 15:09:11', NULL),
(73, 'espironolactona 100 mg comprimido', '2019-11-24 15:09:29', NULL),
(74, 'espironolactona 25 mg comprimido', '2019-11-24 15:09:36', NULL),
(75, 'estriol 1 mg/g (0,1%) creme vaginal bisnaga', '2019-11-24 15:09:45', NULL),
(76, 'estrogÃªnios conjugados 0,3 mg comprimido', '2019-11-24 15:09:57', NULL),
(77, 'fenitoÃ­na 100 mg comprimido', '2019-11-24 15:10:03', NULL),
(78, 'fenobarbital 100 mg comprimido', '2019-11-24 15:10:18', NULL),
(79, 'fenobarbital 40 mg/mL (4%) soluÃ§Ã£o oral gotas frasco', '2019-11-24 15:10:25', NULL),
(80, 'fenoterol 5 mg/mL soluÃ§Ã£o inalante gotas frasco', '2019-11-24 15:10:31', NULL),
(81, 'finasterida 5 mg comprimido', '2019-11-24 15:10:41', NULL),
(82, 'fluconazol 150 mg cÃ¡psula', '2019-11-24 15:10:48', NULL),
(83, 'fluoxetina, cloridrato 20 mg cÃ¡psula', '2019-11-24 15:10:54', NULL),
(84, 'folinato de cÃ¡lcio 15 mg comprimido', '2019-11-24 15:11:01', NULL),
(85, 'formoterol 12 mcg + budesonida 400 mcg po em capsula para inalacao', '2019-11-24 15:11:08', NULL),
(86, 'formoterol 6 mcg + budesonida 200 mcg po em capsula para inalacao', '2019-11-24 15:11:22', NULL),
(87, 'furosemida 40 mg comprimido', '2019-11-24 15:12:04', NULL),
(88, 'glibenclamida 5 mg comprimido', '2019-11-24 15:13:35', NULL),
(89, 'gliclazida 30 mg comprimido de liberaÃ§Ã£o modificada', '2019-11-24 15:13:42', NULL),
(90, 'gliclazida 60 mg comprimido de liberacao prolongada', '2019-11-24 15:13:50', NULL),
(91, 'haloperidol 1 mg comprimido', '2019-11-24 15:13:59', NULL),
(92, 'haloperidol 2 mg/mL (0,2%) soluÃ§Ã£o oral gotas frasco', '2019-11-24 15:14:07', NULL),
(93, 'haloperidol 5 mg comprimido', '2019-11-24 15:14:15', NULL),
(94, 'haloperidol, decanoato 50 mg/mL soluÃ§Ã£o injetÃ¡vel amp. 1 mL', '2019-11-24 15:14:21', NULL),
(95, 'hidroclorotiazida 25 mg comprimido', '2019-11-24 15:14:27', NULL),
(96, 'hidrocortisona, acetato 10 mg/g (1%) creme bisnaga', '2019-11-24 15:14:33', NULL),
(97, 'hidrÃ³xido de alumÃ­nio 60 mg/mL a 63 mg/mL suspensÃ£o oral frasco', '2019-11-24 15:14:39', NULL),
(98, 'hipoclorito de sÃ³dio 25 mg/mL de cloro ativo (2,5 %) solucÃ£o frasco 50 mL', '2019-11-24 15:14:49', NULL),
(99, 'hipromelose 3 mg/mL (0,3%) + dextrana 1 mg/mL solucao oftalmica frasco 15 mL', '2019-11-24 15:15:35', NULL),
(100, 'Ibuprofeno 300 mg comprimido', '2019-11-24 15:15:41', NULL),
(101, 'ibuprofeno 50 mg/mL suspensÃ£o oral gotas frasco', '2019-11-24 15:15:47', NULL),
(102, 'imipramina, cloridrato 25 mg comprimido', '2019-11-24 15:15:55', NULL),
(103, 'insulina humana NPH 100 UI/mL suspensÃ£o injetÃ¡vel fr-amp.', '2019-11-24 15:16:01', NULL),
(104, 'insulina humana regular 100 UI/mL suspensÃ£o injetÃ¡vel fr-amp', '2019-11-24 15:16:08', NULL),
(105, 'ipratrÃ³pio, brometo 0,25 mg/mL (0,025%) soluÃ§Ã£o inalante gotas frasco', '2019-11-24 15:16:33', NULL),
(106, 'isossorbida, dinitrato 5 mg comprimido sublingual', '2019-11-24 15:16:40', NULL),
(107, 'isossorbida, mononitrato 20 mg comprimido', '2019-11-24 15:16:51', NULL),
(108, 'itraconazol 100 mg cÃ¡psula', '2019-11-24 15:17:15', NULL),
(109, 'ivermectina 6 mg comprimido', '2019-11-24 15:17:34', NULL),
(110, 'levodopa 100 mg + benserazida 25 mg capsula de liberacao prolongada (HBS)', '2019-11-24 15:17:43', NULL),
(111, 'levodopa 100 mg + benserazida 25 mg comprimido', '2019-11-24 15:17:52', NULL),
(112, 'levodopa 100 mg + benserazida 25 mg comprimido dispersÃ­vel', '2019-11-24 15:18:01', NULL),
(113, 'levodopa 200 mg + benserazida 50 mg comprimido', '2019-11-24 15:18:10', NULL),
(114, 'levodopa 250 mg + carbidopa 25 mg comprimido', '2019-11-24 15:18:18', NULL),
(115, 'levonorgestrel 0,15 mg + etinilestradiol 0,03 mg comprimido cartela', '2019-11-24 15:18:28', NULL),
(116, 'levonorgestrel 0,75 mg comprimido', '2019-11-24 15:19:09', NULL),
(117, 'levotiroxina sÃ³dica 100 Âµg comprimido', '2019-11-24 15:19:21', NULL),
(118, 'levotiroxina sÃ³dica 25 Âµg comprimido', '2019-11-24 15:19:30', NULL),
(119, 'levotiroxina sÃ³dica 50 Âµg comprimido', '2019-11-24 15:19:57', NULL),
(120, 'loratadina 1 mg/mL soluÃ§Ã£o oral frasco', '2019-11-24 15:20:04', NULL),
(121, 'loratadina 10 mg comprimido', '2019-11-24 15:20:12', NULL),
(122, 'losartana potÃ¡ssica 50 mg comprimido', '2019-11-24 15:20:19', NULL),
(123, 'mebendazol 20 mg/mL suspensÃ£o oral frasco', '2019-11-24 15:20:28', NULL),
(124, 'medroxiprogesterona, acetato 10 mg comprimido', '2019-11-24 15:20:35', NULL),
(125, 'medroxiprogesterona, acetato 150 mg/mL suspensÃ£o injetÃ¡vel amp./framp. 1 mL', '2019-11-24 15:20:42', NULL),
(126, 'metformina, cloridrato 500 mg comprimido', '2019-11-24 15:20:49', NULL),
(127, 'metformina, cloridrato 850 mg comprimido', '2019-11-24 15:20:55', NULL),
(128, 'metildopa 250 mg comprimido', '2019-11-24 15:21:05', NULL),
(129, 'metoclopramida, cloridrato 10 mg comprimido', '2019-11-24 15:21:13', NULL),
(130, 'metronidazol 100 mg/g (10%) creme ou gel vaginal bisnaga', '2019-11-24 15:21:20', NULL),
(131, 'metronidazol 250 mg comprimido', '2019-11-24 15:21:29', NULL),
(132, 'miconazol, nitrato 20 mg/g (2%) creme vaginal bisnaga', '2019-11-24 15:21:36', NULL),
(133, 'nifedipino 20 mg comprimido liberaÃ§Ã£o prolongada', '2019-11-24 15:21:45', NULL),
(134, 'nistatina 100.000 UI/mL suspensÃ£o oral frasco', '2019-11-24 15:21:52', NULL),
(135, 'noretisterona 0,35 mg comprimido cartela', '2019-11-24 15:22:00', NULL),
(136, 'noretisterona enantato 50 mg/mL + estradiol valerato 5 mg/mL soluÃ§Ã£o injetÃ¡vel seringa 1 mL', '2019-11-24 15:22:10', NULL),
(137, 'norfloxacino 400 mg comprimido', '2019-11-24 15:22:18', NULL),
(138, 'nortriptilina, cloridrato 25 mg comprimido', '2019-11-24 15:22:34', NULL),
(139, 'Ã³leo mineral 100 mL frasco', '2019-11-24 15:22:50', NULL),
(140, 'omeprazol 20 mg cÃ¡psula', '2019-11-24 15:22:58', NULL),
(141, 'Ã³xido de zinco 150 a 250 mg/g + retinol (vit.A) 5.000 UI + colecalciferol (vit.D) 400 UI pomada bisnaga 45 g', '2019-11-24 15:23:06', NULL),
(142, 'paracetamol 200 mg/mL soluÃ§Ã£o oral gotas frasco', '2019-11-24 15:23:12', NULL),
(143, 'paracetamol 500 mg comprimido', '2019-11-24 15:23:19', NULL),
(144, 'periciazina 40 mg/mL (4%) soluÃ§Ã£o oral gotas frasco', '2019-11-24 15:23:28', NULL),
(145, 'permetrina 10 mg/mL (1%) loÃ§Ã£o capilar frasco', '2019-11-24 15:23:35', NULL),
(146, 'permetrina 50 mg/mL (5%) creme/loÃ§Ã£o frasco', '2019-11-24 15:23:42', NULL),
(147, 'pilocarpina, cloridrato 20 mg/mL (2%) soluÃ§Ã£o oftÃ¡lmica frasco', '2019-11-24 15:23:51', NULL),
(148, 'piridoxina, cloridrato (vit. B6) 40 mg comprimido', '2019-11-24 15:23:59', NULL),
(149, 'pirimetamina 25 mg comprimido', '2019-11-24 15:24:06', NULL),
(150, 'prednisolona fosfato sodico 4,02 mg/mL (equivalente a 3 mg/mL de prednisolona base) solucao oral frasco 60 mL', '2019-11-24 15:24:19', NULL),
(151, 'prednisona 20 mg comprimido', '2019-11-24 15:24:28', NULL),
(152, 'prednisona 5 mg comprimido', '2019-11-24 15:24:36', NULL),
(153, 'prometazina, cloridrato 25 mg comprimido', '2019-11-24 15:24:56', NULL),
(154, 'propiltiuracila 100 mg comprimido', '2019-11-24 15:27:52', NULL),
(155, 'propranolol, cloridrato 40 mg comprimido', '2019-11-24 15:28:02', NULL),
(156, 'retinol, acetato (vit.A) 50.000 UI/mL + colecalciferol (vit.D) 10.000 UI/mL solucao oral gotas frasco 10 mL', '2019-11-24 15:29:13', NULL),
(157, 'risperidona 2 mg comprimido', '2019-11-24 15:29:22', NULL),
(158, 'sais para reidrataÃ§Ã£o oral pÃ³ para soluÃ§Ã£o oral', '2019-11-24 15:29:32', NULL),
(159, 'salbutamol, sulfato 100 Î¼g/dose aerossol oral frasco', '2019-11-24 15:29:40', NULL),
(160, 'sertralina 50 mg comprimido', '2019-11-24 15:30:20', NULL),
(161, 'sulfadiazina 500 mg comprimido', '2019-11-24 15:30:27', NULL),
(162, 'sulfametoxazol 40 mg/mL + trimetoprima 8 mg/mL suspensao oral frasco 100 mL', '2019-11-24 15:30:34', NULL),
(163, 'sulfametoxazol 800 mg + trimetoprima 160 mg comprimido', '2019-11-24 15:30:42', NULL),
(164, 'sulfato ferroso heptahidratado 125 mg/mL (equivalente a 25 mg de Fe++) solucao oral gotas frasco 30 mL', '2019-11-24 15:30:48', NULL),
(165, 'sulfato ferroso heptahidratado equivalente a 40 mg de Fe++ comprimido', '2019-11-24 15:30:56', NULL),
(166, 'teofilina 100 mg cÃ¡psula de liberaÃ§Ã£o prolongada', '2019-11-24 15:31:03', NULL),
(167, 'tiamazol 5 mg comprimido', '2019-11-24 15:31:12', NULL),
(168, 'tiamina, cloridrato (vit. B1) 300 mg comprimido', '2019-11-24 15:31:24', NULL),
(169, 'timolol, maleato 5 mg/mL (0,5%) soluÃ§Ã£o oftÃ¡lmica frasco', '2019-11-24 15:31:32', NULL),
(170, 'tinidazol 500 mg comprimido', '2019-11-24 15:31:38', NULL),
(171, 'tobramicina 3mg/mL (0,3%) soluÃ§Ã£o oftÃ¡lmica frasco', '2019-11-24 15:31:46', NULL),
(172, 'valproato de sodio 57, 624 mg/mL (equivalente a 50 mg de acido valproico) soluÃ§Ã£o oral ou xarope frasco 100 mL', '2019-11-24 15:31:54', NULL),
(173, 'valproato de sodio 576 mg (equivalente a 500 mg de acido valproico) comprimido revstido ou capsula', '2019-11-24 15:32:00', NULL),
(174, 'varfarina sÃ³dica 2,5 mg comprimido', '2019-11-24 15:32:07', NULL),
(175, 'varfarina sÃ³dica 5 mg comprimido', '2019-11-24 15:32:14', NULL),
(176, 'abacavir, sulfato (ABC) 300 mg comprimido', '2019-11-24 15:32:32', NULL),
(177, 'abacavir, sulfato (ABC) 20 mg/mL soluÃ§Ã£o oral frasco 240 mL', '2019-11-24 15:32:38', NULL),
(178, 'aciclovir 400 mg comprimido', '2019-11-24 15:32:43', NULL),
(179, 'aciclovir 50 mg/g (5%) creme bisnaga', '2019-11-24 15:32:51', NULL),
(180, 'atazanavir, sulfato (ATV) 200 mg cÃ¡psula', '2019-11-24 15:32:57', NULL),
(181, 'atazanavir, sulfato (ATV) 300 mg cÃ¡psula', '2019-11-24 15:33:04', NULL),
(182, 'atorvastatina 10 mg comprimido', '2019-11-24 15:33:10', NULL),
(183, 'bupropiona, cloridrato 150 mg comprimido', '2019-11-24 15:33:17', NULL),
(184, 'cabergolina 0,5 mg comprimido', '2019-11-24 15:33:27', NULL),
(185, 'clofazimina + dapsona + rifampicina (multibacilar) adulto comprimido â€“ blÃ­ster', '2019-11-24 15:33:34', NULL),
(186, 'clofazimina + dapsona + rifampicina (multibacilar) pediÃ¡trico comprimido â€“ blÃ­ster', '2019-11-24 15:33:40', NULL),
(187, 'dapsona + rifampicina (paucibacilar) adulto comprimido â€“ blÃ­ster', '2019-11-24 15:33:46', NULL),
(188, 'dapsona + rifampicina (paucibacilar) pediÃ¡trico comprimido â€“ blÃ­ster', '2019-11-24 15:34:01', NULL),
(189, 'dapsona 100 mg comprimido', '2019-11-24 15:34:08', NULL),
(190, 'darunavir (DRV) 75 mg comprimido', '2019-11-24 15:34:16', NULL),
(191, 'darunavir (DRV) 150 mg comprimido', '2019-11-24 15:34:23', NULL),
(192, 'darunavir (DRV) 600 mg comprimido', '2019-11-24 15:34:31', NULL),
(193, 'didanosina (DDI) 250 mg comprimido de liberaÃ§Ã£o entÃ©rica (EC)', '2019-11-24 15:34:37', NULL),
(194, 'didanosina (DDI) 400 mg comprimido de liberaÃ§Ã£o entÃ©rica (EC)', '2019-11-24 15:34:45', NULL),
(195, 'didanosina (DDI) 10 mg/mL apÃ³s reconstituiÃ§Ã£o pÃ³ para soluÃ§Ã£o oral frasco 4 g', '2019-11-24 15:34:51', NULL),
(196, 'efavirenz (EFZ) 200 mg comprimido', '2019-11-24 15:34:57', NULL),
(197, 'efavirenz (EFZ) 600 mg comprimido', '2019-11-24 15:35:03', NULL),
(198, 'efavirenz (EFZ) 30 mg/mL soluÃ§Ã£o oral fr 180 mL', '2019-11-24 15:35:09', NULL),
(199, 'estavudina (d4T) 1 mg/mL pÃ³ para soluÃ§Ã£o oral fr 200 mL', '2019-11-24 15:35:16', NULL),
(200, 'etambutol, cloridrato 400 mg comprimido', '2019-11-24 15:35:23', NULL),
(201, 'etionamida 250 mg comprimido', '2019-11-24 15:35:29', NULL),
(202, 'etravirina (ETR) 100 mg comprimido', '2019-11-24 15:35:35', NULL),
(203, 'fluconazol 100 mg cÃ¡psula 100 mg', '2019-11-24 15:35:41', NULL),
(204, 'fosamprenavir (FPV) 700 mg comprimido', '2019-11-24 15:35:47', NULL),
(205, 'fosamprenavir (FPV) 50 mg/mL soluÃ§Ã£o oral frasco frasco 225 mL', '2019-11-24 15:35:54', NULL),
(206, 'gabapentina 300 mg comprimido', '2019-11-24 15:36:00', NULL),
(207, 'imiquimode 50 mg/g (5%) creme sachÃª 250 mg', '2019-11-24 15:36:07', NULL),
(208, 'isoniazida 75 mg + rifampicina 150 mg comprimido', '2019-11-24 15:36:12', NULL),
(209, 'isoniazida 100 mg comprimido', '2019-11-24 15:36:20', NULL),
(210, 'lamivudina (3TC) 150 mg comprimido', '2019-11-24 15:36:28', NULL),
(211, 'lamivudina (3TC) 10 mg/mL soluÃ§Ã£o oral frasco 240 mL', '2019-11-24 15:36:35', NULL),
(212, 'loperamida 2 mg comprimido', '2019-11-24 15:36:41', NULL),
(213, 'lopinavir 200 mg + ritonavir (LPV/r) 50 mg cÃ¡psula', '2019-11-24 15:36:47', NULL),
(214, 'lopinavir 100 mg + ritonavir (LPV/r) 25 mg cÃ¡psula', '2019-11-24 15:36:52', NULL),
(215, 'lopinavir 80 mg/mL + ritonavir (LPV/r) 20 mg/mL soluÃ§Ã£o oral frasco 160 mL', '2019-11-24 15:36:58', NULL),
(216, 'maraviroque (MVQ) 150 mg comprimido', '2019-11-24 15:37:05', NULL),
(217, 'nevirapina (NVP) 200 mg comprimido', '2019-11-24 15:37:11', NULL),
(218, 'nevirapina (NVP) 10 mg/mL suspensao oral frasco 100 mL', '2019-11-24 15:37:18', NULL),
(219, 'nevirapina (NVP) 10 mg/mL suspensÃ£o oral frasco 240 mL', '2019-11-24 15:37:26', NULL),
(220, 'nicotina 7 mg adesivo transdÃ©rmico', '2019-11-24 15:37:33', NULL),
(221, 'nicotina 14 mg adesivo transdÃ©rmico', '2019-11-24 15:37:50', NULL),
(222, 'nicotina 21 mg adesivo transdÃ©rmico', '2019-11-24 15:37:57', NULL),
(223, 'nicotina 2 mg goma de mascar', '2019-11-24 15:38:05', NULL),
(224, 'oseltamivir 30 mg cÃ¡psula', '2019-11-24 15:38:11', NULL),
(225, 'oseltamivir 45 mg cÃ¡psula', '2019-11-24 15:38:17', NULL),
(226, 'oseltamivir 75 mg cÃ¡psula', '2019-11-24 15:38:23', NULL),
(227, 'pirazinamida 500 mg comprimido', '2019-11-24 15:38:28', NULL),
(228, 'pirazinamida 30 mg/mL (3%) soluÃ§Ã£o oral frasco', '2019-11-24 15:38:39', NULL),
(229, 'podofilotoxina 1,5 mg/g creme bisnaga 5 g', '2019-11-24 15:38:47', NULL),
(230, 'pravastatina 20 mg comprimido', '2019-11-24 15:38:55', NULL),
(231, 'praziquantel 600 mg comprimido', '2019-11-24 15:39:02', NULL),
(232, 'primaquina 15 mg comprimido', '2019-11-24 15:39:10', NULL),
(233, 'raltegravir (RAL) 100 mg comprimido', '2019-11-24 15:39:18', NULL),
(234, 'raltegravir (RAL) 400 mg comprimido', '2019-11-24 15:39:25', NULL),
(235, 'rifabutina 150 mg cÃ¡psula', '2019-11-24 15:39:33', NULL),
(236, 'rifampicina 300 mg cÃ¡psula', '2019-11-24 15:39:40', NULL),
(237, 'rifampicina 20 mg/ mL (2%) suspensÃ£o oral frasco', '2019-11-24 15:39:46', NULL),
(238, 'rifampicina 150 mg + isoniazida 75 mg + pirazinamida 400 mg + etambutol, cloridrato 275 mg comprimido', '2019-11-24 15:39:54', NULL),
(239, 'ritonavir (RTV) 100 mg cÃ¡psula', '2019-11-24 15:40:01', NULL),
(240, 'ritonavir (RTV) 80 mg/mL soluÃ§Ã£o oral frasco 240 mL', '2019-11-24 15:40:07', NULL),
(241, 'saquinavir (SQV) 200 mg cÃ¡psula gel mole', '2019-11-24 15:40:13', NULL),
(242, 'talidomida 100 mg comprimido', '2019-11-24 15:40:18', NULL),
(243, 'tenofovir desoproxila, fumarato (TDF) 300 mg comprimido', '2019-11-24 15:40:24', NULL),
(244, 'tenofovir (TDF) 300 mg + lamivudina (3TC) 300 mg + efavirenz (EFZ) 600 mg comprimido', '2019-11-24 15:40:30', NULL),
(245, 'tenofovir (TDF) 300 mg + lamivudina (3TC) 300 mg comprimido', '2019-11-24 15:40:36', NULL),
(246, 'tipranavir (TPV) 250 mg cÃ¡psula', '2019-11-24 15:40:42', NULL),
(247, 'tipranavir (TPV) 100 mg/mL soluÃ§Ã£o oral frasco 95 mL', '2019-11-24 15:40:48', NULL),
(248, 'ureia 100 mg/g (10%) creme bisnaga 60 g', '2019-11-24 15:40:53', NULL),
(249, 'valaciclovir 500 mg comprimido', '2019-11-24 15:41:01', NULL),
(250, 'zidovudina (AZT) 100 mg cÃ¡psula', '2019-11-24 15:41:07', NULL),
(251, 'zidovudina (AZT) 10 mg/mL soluÃ§Ã£o injetÃ¡vel fr-amp. 20 mL', '2019-11-24 15:41:15', NULL),
(252, 'zidovudina (AZT) 10 mg/mL soluÃ§Ã£o oral frasco 200 mL', '2019-11-24 15:41:22', NULL),
(253, 'zidovudina 300 mg + lamivudina 150 mg comprimido', '2019-11-24 15:41:28', NULL),
(254, 'alendronato de sÃ³dio 10 mg comprimido', '2019-11-24 15:41:36', NULL),
(255, 'alendronato de sÃ³dio 70 mg comprimido', '2019-11-24 15:41:42', NULL),
(256, 'metilfenidato 10 mg comprimido', '2019-11-24 15:41:47', NULL),
(257, 'sinvastatina 10 mg comprimido', '2019-11-24 15:41:53', NULL),
(258, 'sinvastatina 20 mg comprimido', '2019-11-24 15:41:59', NULL),
(259, 'sinvastatina 40 mg comprimido', '2019-11-24 15:42:05', NULL);


create table qtd (
    `qtd_id` integer not null auto_increment primary key,
    `qtd_nome` varchar(6) not null
)engine=innodb, charset=utf8;

INSERT INTO `qtd` (`qtd_id`, `qtd_nome`) VALUES
(1, 'Alta'),
(2, 'Normal'),
(3, 'Baixa');

create table servico (
    `servico_id` integer not null auto_increment primary key,
    `servico_farmacia` integer not null,
    `servico_remedio` integer not null,
    `servico_status` tinyint not null DEFAULT '1',
    `servico_qtd` integer not null DEFAULT '2',
    `servico_create` datetime not null,
    `servico_update` datetime null,
    FOREIGN KEY(`servico_farmacia`) references farmacia(`farmacia_id`),
    FOREIGN KEY(`servico_remedio`) references remedio(`remedio_id`),
    FOREIGN KEY(`servico_qtd`) references qtd(`qtd_id`)
)engine=innodb, charset=utf8;



create table usuario (
    `usuario_id` integer not null auto_increment primary key,
    `usuario_nome` varchar(100) not null,
    `usuario_email` varchar(100) not null,
    `usuario_senha` varchar(255) not null,
    `usuario_code` varchar(5) null,
    `usuario_uf` char(2) not null,
    `usuario_acess` varchar(255) null,
    `usuario_status` tinyint not null DEFAULT '0',
    `usuario_create` datetime not null,
    `usuario_update` datetime null,
    `usuario_delete` datetime null
)engine=innodb, charset=utf8;



create table envio (
    `envio_id` integer not null auto_increment primary key,
    `envio_usuario` integer not null,
    `envio_remedio` varchar(255) not null,
    `envio_posto` integer not null,
    `envio_estimada` date not null,
    `envio_entrega` datetime null,
    `envio_status` tinyint not null DEFAULT '0',
    `envio_create` datetime not null,
    `envio_update` datetime null,
    `envio_delete` datetime null
)engine=innodb, charset=utf8;


create table recebimento (
    `recebimento_id` integer not null auto_increment primary key,
    `recebimento_envio` integer not null,
    `recebimento_status` tinyint not null DEFAULT '1',
    `recebimento_create` datetime not null,
    `recebimento_update` datetime null,
    FOREIGN KEY(`recebimento_envio`) references envio(`envio_id`)
)engine=innodb, charset=utf8;

create table doacao (
    `doacao_id` integer not null auto_increment primary key,
    `doacao_recebimento` integer not null,
    `doacao_status` tinyint DEFAULT '1' not null,
    `doacao_create` datetime not null,
    `doacao_update` datetime null
)engine=innodb, charset=utf8;