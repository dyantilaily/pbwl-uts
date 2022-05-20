CREATE DATABASE dbmyfarm;

USE dbmyfarm;

CREATE TABLE tb_user (
  id_user INT(4) NOT NULL AUTO_INCREMENT,
  nama_user VARCHAR(50),
  tgllahir_user DATETIME,
  uname_user VARCHAR(50),
  password VARCHAR(50),
  PRIMARY KEY (id_user)
);

CREATE TABLE tb_penjaga (
  id_penjaga INT(3) NOT NULL AUTO_INCREMENT,
  nama_penjaga VARCHAR(50),
  umur_penjaga INT(3),
  PRIMARY KEY (id_penjaga),
  UNIQUE KEY (nama_penjaga)
);

CREATE TABLE tb_makanan (
  id_makanan INT(3) NOT NULL AUTO_INCREMENT,
  nama_makanan VARCHAR(50),
  harga_makanan DOUBLE,
  PRIMARY KEY (id_makanan),
  UNIQUE KEY (nama_makanan)
);

CREATE TABLE tb_hewan (
  id_hewan INT(3) NOT NULL AUTO_INCREMENT,
  nama_hewan VARCHAR(50),
  jenis_hewan VARCHAR(50),
  id_makanan_hewan INT(3),
  id_penjaga_hewan INT(3),
  PRIMARY KEY (id_hewan),
  UNIQUE KEY (nama_hewan),
  FOREIGN KEY (id_makanan_hewan) REFERENCES tb_makanan(id_makanan),
  FOREIGN KEY (id_penjaga_hewan) REFERENCES tb_penjaga(id_penjaga)
);