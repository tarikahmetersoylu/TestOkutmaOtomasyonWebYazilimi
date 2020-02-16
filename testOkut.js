// JavaScript Document
var ogrenciler = new Array();
var cevaplar = new Array();
function readOgrenciText(that) {
	if (that.files && that.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
			var text = e.target.result;
			ogrenciBol(text);
		}; //end onload()
		reader.readAsText(that.files[0]);

	} //end if html5 filelist support
}
function getOgrencilerLength() {
	return ogrenciler.length;
}
for (let i = 0; i < ogrenciler.length; i++) {
	ogrenciler[i]=[];
}

function ogrenciBol(text) {
	var a = text.split("\n");
	for (let i = 0; i < a.length; i++) {
		ogrenciler[i] = a[i];
	}
}

function getAd(isim) {
	var a = isim.slice(0, 12);
	return a;
}

function getSoyad(soyisim) {
	var a = soyisim.slice(12, 24);
	return a;
}

function getNumara(no) {
	var a = no.slice(24, 33);
	return a;
}

function getGrup(grup) {
	var a = grup.slice(33, 34);
	return a;
}
function getCevap(ogrenci_cevap)
{
	var x = ogrenci_cevap.slice(34);
	x = x.split("");
	return x;
}
function readCevapAnahtari(file) {
	readCevapText(file);
}
function readCevapText(that) {
	if (that.files && that.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
			var text = e.target.result;
			cevapAnahtariOlustur(text);
		}; //end onload()
		reader.readAsText(that.files[0]);

	} //end if html5 filelist support
}
function cevapAnahtariOlustur(text) {
	var c = text.split("\n");
	for (let i = 0; i < c.length; i++) {
		cevaplar[i] = c[i];
		cevaplar[i] = cevaplar[i].split(":");
	}
}
function grupveCevaplar()
{

}

function cevaplariOkut(adi) {
	ogrenciBilgi = new Array();

	var toplamPuan = 0;
	var puan = 0;
	soruSayisi = cevaplar[0][1].split("").length - 1;
	var dogruYapanSayi = new Array();
	puan = (100 / soruSayisi);
	for (let i = 0; i < soruSayisi; i++) {
		dogruYapanSayi[i] = 0;
	}
	cevapAnahtari = [soruSayisi];
	for (let i = 0; i < ogrenciler.length; i++) {
		ogrenciBilgi[i] = [];
	}
	for (let i = 0; i < ogrenciler.length; i++) {
		ogrenciBilgi[i][0] = getAd(ogrenciler[i]);
		ogrenciBilgi[i][1] = getSoyad(ogrenciler[i]);
		ogrenciBilgi[i][2] = getNumara(ogrenciler[i]);
		ogrenciBilgi[i][3] = getGrup(ogrenciler[i]);
		var ogrenciCevap = getCevap(ogrenciler[i]);
		for (let j = 4; j < soruSayisi + 4; j++) {
			ogrenciBilgi[i][j] = ogrenciCevap[j-4];
		}
	}
	for (let i = 0; i < ogrenciBilgi.length; i++) {
		for (let c = 0; c < cevaplar.length; c++) {
			if (ogrenciBilgi[i][3] == cevaplar[c][0]) {
				cevapAnahtari = cevaplar[c][1].split("");
			}
			else {

			}
		}

		for (let j = 4; j < soruSayisi + 4; j++) {
				if (ogrenciBilgi[i][j] == cevapAnahtari[j-4]) {
					ogrenciBilgi[i][j] = Number(puan.toFixed(3));
					toplamPuan += puan;
					dogruYapanSayi[j-4] += 1;
				}
				else if (ogrenciBilgi[i][j] == " ") {
					ogrenciBilgi[i][j] = 0;
				}
				else {
					ogrenciBilgi[i][j] = 0;
				}
			
		}
		ogrenciBilgi[i][4 + soruSayisi] = Number(toplamPuan.toFixed(3));
		toplamPuan = 0;
	}

	soruOrtalama(dogruYapanSayi, ogrenciler.length, puan);
	exportToCsv(ogrenciBilgi, adi);
}
function soruOrtalama(dogurYapanKisiSayisi, ogrenciSayisi, sorununPuani) {
	var ortalama = new Array();
	ogrenciBilgi[ogrenciBilgi.length - 1][3] = "Ortalama";
	for (let i = 0; i < 30; i++) {
		//ortalama[i] = (dogurYapanKisiSayisi[i-1] * sorununPuani) / ogrenciSayisi;
		ogrenciBilgi[ogrenciBilgi.length - 1][i+4] = (dogurYapanKisiSayisi[i] * sorununPuani) / ogrenciSayisi;
	}
}

exportToCsv = function (dosya, dosyaAdi) {
	dosyaAdi += ".csv";
	var CsvString = "";
	dosya.forEach(function (RowItem, RowIndex) {
		RowItem.forEach(function (ColItem, ColIndex) {
			CsvString += ColItem + ",";
		});
		CsvString += "\r\n";
	});
	CsvString = "data:application/csv," + encodeURIComponent(CsvString);
	var x = document.createElement("A");
	x.setAttribute("href", CsvString);
	x.setAttribute("download", dosyaAdi);
	document.body.appendChild(x);
	x.click();
}