-- MySQL dump 10.13  Distrib 5.7.20, for Win64 (x86_64)
--
-- Host: localhost    Database: pamira_stone
-- ------------------------------------------------------
-- Server version	5.7.20-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cari_yetkililer`
--

DROP TABLE IF EXISTS `cari_yetkililer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cari_yetkililer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cari_id` int(11) NOT NULL,
  `isim` tinytext NOT NULL,
  `eposta` tinytext,
  `telefon` tinytext,
  `notlar` mediumtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cari_yetkililer`
--

LOCK TABLES `cari_yetkililer` WRITE;
/*!40000 ALTER TABLE `cari_yetkililer` DISABLE KEYS */;
/*!40000 ALTER TABLE `cari_yetkililer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cariler`
--

DROP TABLE IF EXISTS `cariler`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cariler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unvan` text NOT NULL,
  `eposta` tinytext,
  `telefon_1` tinytext,
  `telefon_2` tinytext,
  `faks_no` tinytext,
  `adres` text NOT NULL,
  `il` tinytext NOT NULL,
  `ilce` tinytext NOT NULL,
  `tur` tinytext NOT NULL,
  `mali_tur` tinytext NOT NULL,
  `iban` tinytext NOT NULL,
  `vkn_tckn` tinytext NOT NULL,
  `vergi_dairesi` tinytext,
  `eklenme_tarihi` datetime DEFAULT NULL,
  `son_duzenlenme_tarihi` datetime DEFAULT NULL,
  `bakiye` double DEFAULT '0',
  `durum` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cariler`
--

LOCK TABLES `cariler` WRITE;
/*!40000 ALTER TABLE `cariler` DISABLE KEYS */;
/*!40000 ALTER TABLE `cariler` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cookie_tokens`
--

DROP TABLE IF EXISTS `cookie_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cookie_tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `selector` text NOT NULL,
  `token` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cookie_tokens`
--

LOCK TABLES `cookie_tokens` WRITE;
/*!40000 ALTER TABLE `cookie_tokens` DISABLE KEYS */;
INSERT INTO `cookie_tokens` VALUES (1,1,'Rl/sFt/rshei','c8bc9ab21d5c12a68f10ec35d2af674c04f76d3e169075b31b07b7709095772e'),(2,2,'LQCl5q6Mu5G7','3d9ed6d3897dc5dad8045a994038b1124f96228be57d9e66d934377717d2f8e1');
/*!40000 ALTER TABLE `cookie_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fatura_css`
--

DROP TABLE IF EXISTS `fatura_css`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fatura_css` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profil_ismi` text NOT NULL,
  `duzenlenme_tarihi_1` varchar(150) NOT NULL,
  `duzenlenme_tarihi_2` varchar(150) NOT NULL,
  `duzenlenme_saati_1` varchar(150) NOT NULL,
  `duzenlenme_saati_2` varchar(150) NOT NULL,
  `cari_unvan` varchar(150) NOT NULL,
  `cari_adres` varchar(150) NOT NULL,
  `cari_il_ilce` varchar(150) NOT NULL,
  `cari_vergi_dairesi` varchar(150) NOT NULL,
  `cari_tckn_vno` varchar(150) NOT NULL,
  `ara_toplam` varchar(150) NOT NULL,
  `kdv` varchar(150) NOT NULL,
  `genel_toplam` varchar(150) NOT NULL,
  `genel_toplam_yaziyla` varchar(150) NOT NULL,
  `stok_detaylari` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fatura_css`
--

LOCK TABLES `fatura_css` WRITE;
/*!40000 ALTER TABLE `fatura_css` DISABLE KEYS */;
INSERT INTO `fatura_css` VALUES (1,'obarey','52#158','9#118','30#139','-11#180','201#99','181#127','160#154','218#260','31#260','-135#634','-157#662','-179#690','37#620','-55#166');
/*!40000 ALTER TABLE `fatura_css` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fatura_stok_detaylari`
--

DROP TABLE IF EXISTS `fatura_stok_detaylari`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fatura_stok_detaylari` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fatura_id` int(11) NOT NULL,
  `stok_kodu` text NOT NULL,
  `stok_adi` text NOT NULL,
  `birim_fiyat` double NOT NULL DEFAULT '0',
  `miktar` double NOT NULL DEFAULT '0',
  `birim` text,
  `kdv_orani` double NOT NULL DEFAULT '18',
  `toplam` double NOT NULL DEFAULT '0',
  `kdv_dahil` tinyint(1) DEFAULT '1',
  `yer` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='kdv_orani';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fatura_stok_detaylari`
--

LOCK TABLES `fatura_stok_detaylari` WRITE;
/*!40000 ALTER TABLE `fatura_stok_detaylari` DISABLE KEYS */;
/*!40000 ALTER TABLE `fatura_stok_detaylari` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faturalar`
--

DROP TABLE IF EXISTS `faturalar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `faturalar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fatura_no` text,
  `aciklama` text,
  `cari_id` int(11) NOT NULL,
  `cari_kayit_id` int(11) NOT NULL,
  `duzenlenme_tarihi` datetime NOT NULL,
  `user` int(11) NOT NULL,
  `eklenme_tarihi` datetime NOT NULL,
  `fis_turu` tinyint(4) NOT NULL DEFAULT '1',
  `durum` tinyint(4) NOT NULL DEFAULT '1',
  `ara_toplam` double NOT NULL DEFAULT '0',
  `genel_toplam` double NOT NULL DEFAULT '0',
  `kdv_miktar` double NOT NULL DEFAULT '0',
  `genel_toplam_yaziyla` text NOT NULL,
  `versiyon` tinyint(2) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='resmi';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faturalar`
--

LOCK TABLES `faturalar` WRITE;
/*!40000 ALTER TABLE `faturalar` DISABLE KEYS */;
/*!40000 ALTER TABLE `faturalar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item_cari_kayitlar`
--

DROP TABLE IF EXISTS `item_cari_kayitlar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item_cari_kayitlar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_tip` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `unvan` text NOT NULL,
  `adres` text NOT NULL,
  `il` text NOT NULL,
  `ilce` text NOT NULL,
  `mali_tur` tinytext NOT NULL,
  `telefon_1` tinytext,
  `telefon_2` tinytext,
  `tur` tinytext NOT NULL,
  `vkn_tckn` text,
  `vergi_dairesi` tinytext,
  `eposta` text,
  `iban` text,
  `faks_no` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item_cari_kayitlar`
--

LOCK TABLES `item_cari_kayitlar` WRITE;
/*!40000 ALTER TABLE `item_cari_kayitlar` DISABLE KEYS */;
/*!40000 ALTER TABLE `item_cari_kayitlar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kullanicilar`
--

DROP TABLE IF EXISTS `kullanicilar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kullanicilar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `isim` text NOT NULL,
  `eposta` text NOT NULL,
  `salt` text NOT NULL,
  `pass` text NOT NULL,
  `seviye` tinyint(1) NOT NULL,
  `durum` tinyint(1) NOT NULL DEFAULT '1',
  `son_giris` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kullanicilar`
--

LOCK TABLES `kullanicilar` WRITE;
/*!40000 ALTER TABLE `kullanicilar` DISABLE KEYS */;
INSERT INTO `kullanicilar` VALUES (1,'Ahmet Ziya Kanbur','ahmetkanbur@gmail.com','<7ãP&$Vöæ¼*©)exÀ½¬PÍýç¦ ÉlfÓKú«÷\'ïZÍ\0¶Üýá©;Ë$E','75f64d24974a48b3cc11964af015d02f0be8bbb48e08cdd3930dccb4b0e3efa4',3,1,'2017-12-09 11:06:40'),(2,'Halim Kanbur','hkanbur@gmail.com','W÷oÍQþV0>z³-Æ¸h\\ô¤IeµØ¹Ä4É.£Âþôæýä^¶P¬O\n**[¥j}ÓÚÍ','c429b8260e8882537a6055488dbc2e8c068471a4977775059f3e262a373cff64',3,1,'2017-12-09 13:53:56'),(3,'Test','test@test.com','M÷;5viX8xcÀ©Ê½ÕyØÉâ^ÌªW[j3¥Éô Âx9]Ìh¹Ñçl$Ç1+\Z\\Ë)','68803a039d34306878af958c1a5d04cbf1792a27660aedf3e47d77a2a91d2607',1,1,'2017-12-09 16:36:34');
/*!40000 ALTER TABLE `kullanicilar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `magaza_fisleri`
--

DROP TABLE IF EXISTS `magaza_fisleri`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `magaza_fisleri` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tarih` date NOT NULL,
  `user` int(11) NOT NULL,
  `toplam` double NOT NULL DEFAULT '0',
  `eklenme_tarihi` datetime NOT NULL,
  `durum` int(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `magaza_fisleri`
--

LOCK TABLES `magaza_fisleri` WRITE;
/*!40000 ALTER TABLE `magaza_fisleri` DISABLE KEYS */;
/*!40000 ALTER TABLE `magaza_fisleri` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `magaza_fisleri_urunler`
--

DROP TABLE IF EXISTS `magaza_fisleri_urunler`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `magaza_fisleri_urunler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `urun` text,
  `fiyat` double NOT NULL DEFAULT '0',
  `miktar` double NOT NULL DEFAULT '0',
  `toplam` double NOT NULL DEFAULT '0',
  `fis` int(11) NOT NULL,
  `odeme_tipi` varchar(250) NOT NULL,
  `durum` int(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `magaza_fisleri_urunler`
--

LOCK TABLES `magaza_fisleri_urunler` WRITE;
/*!40000 ALTER TABLE `magaza_fisleri_urunler` DISABLE KEYS */;
/*!40000 ALTER TABLE `magaza_fisleri_urunler` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `odeme_kartlari`
--

DROP TABLE IF EXISTS `odeme_kartlari`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `odeme_kartlari` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `isim` text NOT NULL,
  `tip` varchar(200) NOT NULL,
  `toplam` double DEFAULT '0',
  `kalan` double DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `odeme_kartlari`
--

LOCK TABLES `odeme_kartlari` WRITE;
/*!40000 ALTER TABLE `odeme_kartlari` DISABLE KEYS */;
/*!40000 ALTER TABLE `odeme_kartlari` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `odemeler`
--

DROP TABLE IF EXISTS `odemeler`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `odemeler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kart` text NOT NULL,
  `odeme_tipi` varchar(250) NOT NULL,
  `banka_ekstra` text NOT NULL,
  `tutar` double NOT NULL DEFAULT '0',
  `user` int(11) NOT NULL,
  `tarih` date NOT NULL,
  `aciklama` text,
  `eklenme_tarihi` datetime NOT NULL,
  `duzenlenme_tarihi` datetime DEFAULT NULL,
  `durum` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `odemeler`
--

LOCK TABLES `odemeler` WRITE;
/*!40000 ALTER TABLE `odemeler` DISABLE KEYS */;
/*!40000 ALTER TABLE `odemeler` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stok_hareketleri`
--

DROP TABLE IF EXISTS `stok_hareketleri`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stok_hareketleri` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tip` varchar(40) NOT NULL,
  `user` int(11) NOT NULL,
  `tarih` date NOT NULL,
  `eklenme_tarihi` datetime NOT NULL,
  `fis_no` int(11) DEFAULT '0',
  `durum` int(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stok_hareketleri`
--

LOCK TABLES `stok_hareketleri` WRITE;
/*!40000 ALTER TABLE `stok_hareketleri` DISABLE KEYS */;
/*!40000 ALTER TABLE `stok_hareketleri` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stok_hareketleri_urunler`
--

DROP TABLE IF EXISTS `stok_hareketleri_urunler`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stok_hareketleri_urunler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hareket_id` int(11) NOT NULL,
  `stok_kodu` text NOT NULL,
  `stok_adi` text NOT NULL,
  `miktar` double NOT NULL,
  `yer` text NOT NULL,
  `durum` int(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stok_hareketleri_urunler`
--

LOCK TABLES `stok_hareketleri_urunler` WRITE;
/*!40000 ALTER TABLE `stok_hareketleri_urunler` DISABLE KEYS */;
/*!40000 ALTER TABLE `stok_hareketleri_urunler` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stok_kartlari`
--

DROP TABLE IF EXISTS `stok_kartlari`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stok_kartlari` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stok_kodu` text NOT NULL,
  `stok_adi` text NOT NULL,
  `urun_grubu` int(11) NOT NULL,
  `satis_fiyati` double NOT NULL DEFAULT '0',
  `alis_fiyati` double NOT NULL DEFAULT '0',
  `kdv_dahil` double NOT NULL DEFAULT '0',
  `kdv_orani` double NOT NULL DEFAULT '0',
  `stok_miktar` double DEFAULT '0',
  `birim` tinytext NOT NULL,
  `durum` int(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stok_kartlari`
--

LOCK TABLES `stok_kartlari` WRITE;
/*!40000 ALTER TABLE `stok_kartlari` DISABLE KEYS */;
/*!40000 ALTER TABLE `stok_kartlari` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stok_kartlari_stoklar`
--

DROP TABLE IF EXISTS `stok_kartlari_stoklar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stok_kartlari_stoklar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stok_karti` text NOT NULL,
  `yer` text NOT NULL,
  `miktar` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stok_kartlari_stoklar`
--

LOCK TABLES `stok_kartlari_stoklar` WRITE;
/*!40000 ALTER TABLE `stok_kartlari_stoklar` DISABLE KEYS */;
/*!40000 ALTER TABLE `stok_kartlari_stoklar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stok_kartlari_urun_gruplari`
--

DROP TABLE IF EXISTS `stok_kartlari_urun_gruplari`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stok_kartlari_urun_gruplari` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `isim` text NOT NULL,
  `durum` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stok_kartlari_urun_gruplari`
--

LOCK TABLES `stok_kartlari_urun_gruplari` WRITE;
/*!40000 ALTER TABLE `stok_kartlari_urun_gruplari` DISABLE KEYS */;
INSERT INTO `stok_kartlari_urun_gruplari` VALUES (1,'Doğal Taş',1),(2,'Tanımsız',1);
/*!40000 ALTER TABLE `stok_kartlari_urun_gruplari` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stok_yerler`
--

DROP TABLE IF EXISTS `stok_yerler`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stok_yerler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `isim` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stok_yerler`
--

LOCK TABLES `stok_yerler` WRITE;
/*!40000 ALTER TABLE `stok_yerler` DISABLE KEYS */;
INSERT INTO `stok_yerler` VALUES (1,'Mağaza'),(2,'Beykoz'),(3,'Depo');
/*!40000 ALTER TABLE `stok_yerler` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tahsilat_makbuzlari`
--

DROP TABLE IF EXISTS `tahsilat_makbuzlari`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tahsilat_makbuzlari` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cari_id` int(11) NOT NULL,
  `cari_kayit_id` int(11) NOT NULL,
  `tutar` double NOT NULL DEFAULT '0',
  `tip` tinyint(4) NOT NULL,
  `tahsilat_tipi` varchar(50) NOT NULL,
  `tarih` date NOT NULL,
  `banka` text,
  `cek_no` text,
  `cek_vade` date DEFAULT NULL,
  `eklenme_tarihi` datetime NOT NULL,
  `user` int(11) NOT NULL,
  `durum` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tahsilat_makbuzlari`
--

LOCK TABLES `tahsilat_makbuzlari` WRITE;
/*!40000 ALTER TABLE `tahsilat_makbuzlari` DISABLE KEYS */;
/*!40000 ALTER TABLE `tahsilat_makbuzlari` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-01-31 20:35:22
