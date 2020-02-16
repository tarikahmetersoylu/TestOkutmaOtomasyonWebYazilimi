create database yazilimdb;
use yazilimdb;
create table if not exists admins (
    kullaniciAdi varchar(18) not null primary key,
    sifre varchar(16) not null
);
create table if not exists ogretimUye (
    sicilNo int not null primary key,
    adi varchar(50),
    soyadi varchar(50),
    sifre varchar(12)
);
create table if not exists fakulte (
    fakulteNo int primary key not null,
    fakulteAdi varchar(60) not null
);
create table if not exists bolum (
    fakulteNo int not null,
    constraint fk_fakulteNo foreign key bolum(fakulteNo) references fakulte(fakulteNo),
    bolumNo int primary key not null,
    bolumAdi varchar(60) not null,
    bolumKazanim varchar(200)
);
create table if not exists donem(
    donemId int not null primary key,
    donemAdi varchar(50) not null
);
create table if not exists dersler (
    dersKodu varchar(10) primary key not null,
    dersAdi varchar(30) not null,
    bolumNo int not null,
    constraint fk_ders_bolumNo foreign key dersler(bolumNo) references bolum(bolumNo),
    dersKazanim varchar(200)
);
create table if not exists dersAtama(
    dersKodu varchar(10) not null,
    constraint fk_dersKodu foreign key dersAtama(dersKodu) references dersler(dersKodu),
    bolumNo int not null,
    constraint fk_bolumNo foreign key dersAtama(bolumNo) references bolum(bolumNo),
    sicilNo int not null,
    constraint fk_sicilNo foreign key dersAtama(sicilNo) references ogretimUye(sicilNo),
    donemId int not null,
    constraint fk_donemId foreign key dersAtama(donemId) references donem(donemId)
);
insert into admins (kullaniciAdi,sifre) value
("ali","a");
insert into ogretimUye (sicilNo,adi,soyadi,sifre) value
(1,"ahmet","ucar","a");