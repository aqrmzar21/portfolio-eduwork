// ini komentar satu baris

/*
ini komentar lebih dari satu baris
*/

let variabel = "ini adalah variabel";
// console.log(variabel);

const konstanta = "ini adalah konstanta";
const angka = 10;

let kali = angka * angka;
// console.log(kali); 

if (angka > 5) {
  console.log("angka lebih besar dari 5");
}
else {
  console.log("angka lebih kecil dari 5");
}

for (let i = 0; i < 10; i++) {
  console.log(i);
}

function tambah(a, b) {
  return a + b;
}

// arrow function
// const great => () => "hello world"; {
//   Console.log("hello world");
// }

// const great = () => {
//   console.log("hello world");
// }

// array

const array = ["satu", "dua", "tiga", "empat", "lima"];
// console.log(array);

// ini menghapus data di array
array.pop('dua');
// array.pop();

// ini menyimpan data baru di array
array.push("enam");
console.log(array[2]);
