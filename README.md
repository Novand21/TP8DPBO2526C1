
## Janji
Saya Muhamad Raditya Novandrian dengan NIM 2508283 mengerjakan TP-8 dalam mata kuliah DPBO untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan.

### Desain Class & Arsitektur MVC
- **Arsitektur MVC (Model-View-Controller):** Memisahkan pengelolaan database (Model), tampilan antarmuka (**View**), dan logika kendali aplikasi Controller agar kode lebih terstruktur dan mudah dikelola.
- **Inheritance & Encapsulation:** Seluruh class model (`Department`, `Lecturer`, `Course`) mewarisi class `DB` untuk menjalankan query, sedangkan instance model di dalam setiap controller bersifat `private`.
- **Relasi Database (`db_lecturer`):** Terdiri dari 3 tabel yang saling berelasi menggunakan foreign key, yaitu: departement - lecturer(many to one), lecturer - course(one to many).

## Penjelasan Atribut dan Methods

### Class `Config` & `DB`
- **Deskripsi:** Menyimpan kredensial server dan mengelola siklus koneksi ke database MySQL `db_lecturer`
- **Atribut:**
  - `$db_host`, `$db_user`, `$db_pass`, `$db_name` (`public static` pada `Config`): Konfigurasi koneksi database.
  - `$db_link`, `$result`: Menyimpan objek koneksi aktif dan hasil eksekusi query pada `DB`.
- **Methods Utama:**
  - `open()` & `close()`: Membuka dan menutup koneksi database.
  - `execute($query)`: Menjalankan perintah SQL ke database. * `getResult()`: Mengambil baris data hasil query dalam bentuk array.  

### Class `Department`, `Lecturer`, & `Course` (Model) 
- **Deskripsi:** Mewarisi class `DB` dan bertanggung jawab atas seluruh query CRUD pada masing-masing tabel. 
- **Methods Utama:** 
  - `get...()` & `get...ById($id)`: Mengambil seluruh data atau satu data berdasarkan `id`. Pada `Lecturer` ,`Course`, dan `Department`, digunakan untuk menampilkan nama department dan nama dosen secara langsung.
  - `add($data)` & `edit($data)`: Menambahkan data baru dan memperbarui data ke dalam tabel.
  - `delete($id)`: Menghapus baris data berdasarkan `id`.  

### Class `DepartmentView`, `LecturerView`, & `CourseView` (View) 
- **Deskripsi:** Mengatur tampilan antarmuka pengguna tanpa mencampurkan logika query database. 
- **Methods Utama:** 
  - `render($data)`: Menampilkan tabel daftar data utama beserta tombol aksi (*Edit* dan *Delete*).
  - `renderAdd(...)`: Menampilkan form tambah data.
  - `renderEdit(...)`: Menampilkan form ubah data yang sudah terisi.

### Class `DepartmentController`, `LecturerController`, & `CourseController` (Controller)
- **Deskripsi:** Menjadi penghubung antara request pengguna, Model, dan View.
- **Atribut:**
  - Properti model terkait (seperti `$lecturer`, `$department`, `$course`) untuk mengakses database. * **Methods Utama:** 
  - `index()`: Membuka koneksi, mengambil data dari Model ke dalam array, menutup koneksi, lalu mengirimkannya ke `View->render()`. 
  - `add()` & `edit()`: Menampilkan form melalui View saat diakses via `GET`, atau menyimpan perubahan ke Model dan melakukan *redirect* saat form dikirim via `POST`. 
  - `delete()`: Menghapus data berdasarkan `$_GET['id']` lalu mengarahkan kembali ke halaman utama modul.

## Penjelasan Alur Program

- **HTTP Request & Routing (`index.php`):** Saat aplikasi diakses, index.php bertindak sebagai front controller yang membaca parameter URL `page`: (`lecturers`, `departments`, `courses`) dan `action`: (`index`, `add`, `edit`, `delete`), lalu memanggil Controller dan method yang sesuai.
- **Pemrosesan Data (Controller & Model):** Controller membuka koneksi database (`open()`), memanggil method CRUD pada Model (dengan input dari `$_GET` atau `$_POST`), menampung hasil ke array, lalu menutup koneksi.
- **Render Tampilan (View):** Untuk halaman tampilan atau form, Controller membuat objek View dan memanggil `render()`, `renderAdd()`, atau `renderEdit()` untuk mencetak halaman HTML ke browser.

## Dokumentasi (Video)
https://github.com/user-attachments/assets/2607d1ac-4ad9-429b-8dc8-c4234cb58e4
