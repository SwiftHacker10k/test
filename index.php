<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>3,5 Tahun Let's Go</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="money.css">
</head>
<body>
    <nav class="mb-4">
        <div class="logo">Pengeluaran</div>
        <ul class="nav-links">
            <li><a href="home.html">Home</a></li>
            <li><a href="index.php">Money</a></li>
            <li><a href="project.php">Project</a></li>
            <li><a href="home.html">Contact</a></li>
        </ul>
    </nav>

    <div class="container">
        <h2 class="mb-4">Pengeluaran</h2>
        <form id="expense-form">
            <div class="form-group row">
                <label for="expense-date" class="col-sm-2 col-form-label">Tanggal</label>
                <div class="col-sm-10">
                    <input type="date" id="expense-date" name="date" class="form-control" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="expense-category" class="col-sm-2 col-form-label">Kategori</label>
                <div class="col-sm-10">
                    <select id="expense-category" name="category" class="form-control" required>
                        <option value=""> </option>    
                        <option value="Makanan">Makanan</option>
                        <option value="Kebutuhan">Kebutuhan</option>
                        <option value="Keperluan">Keperluan</option>
                        <option value="Game">Game</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="expense-description" class="col-sm-2 col-form-label">Deskripsi</label>
                <div class="col-sm-10">
                    <input type="text" id="expense-description" name="description" class="form-control" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="expense-amount" class="col-sm-2 col-form-label">Keluaran (IDR)</label>
                <div class="col-sm-10">
                    <input type="number" id="expense-amount" name="amount" class="form-control" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Tambah Pengeluaran</button>
        </form>
    <video autoplay muted loop class="video-background">
        <source src="WhatsApp Video 2024-06-15 at 08.29.45_031a8d36.mp4" type="video/mp4">
        Browser Anda tidak mendukung tag video HTML5.
    </video>
        <h2 class="mt-5">Daftar Pengeluaran</h2>
        <table class="table mt-3 vip-table">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Kategori</th>
                    <th>Deskripsi</th>
                    <th>Keluaran (IDR)</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="expense-info">
                <!-- Baris akan ditambahkan melalui JavaScript -->
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#expense-form").submit(function(event) {
                event.preventDefault();

                var formData = {
                    date: $("#expense-date").val(),
                    category: $("#expense-category").val(),
                    description: $("#expense-description").val(),
                    amount: $("#expense-amount").val()
                };

                $.ajax({
                    type: "POST",
                    url: "Databases.php",
                    data: formData,
                    dataType: "json",
                    encode: true,
                    success: function(data) {
                        console.log(data);
                        if (data.success) {
                            addExpenseRow(formData.date, formData.category, formData.description, formData.amount);
                            $("#expense-form")[0].reset();
                        } else {
                            alert("Error: " + data.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error: " + status + error);
                    }
                });
            });

            function addExpenseRow(date, category, description, amount) {
                var newRow = `
                    <tr>
                        <td>${date}</td>
                        <td>${category}</td>
                        <td>${description}</td>
                        <td>Rp ${formatRupiah(amount)}</td>
                        <td>
                            <button type="button" class="btn-icon delete-expense">
                                <img src="https://static.vecteezy.com/system/resources/previews/000/594/236/original/trash-can-icon-logo-template-illustration-design-vector-eps-10.jpg" alt="Delete">
                            </button>
                        </td>
                    </tr>
                `;
                $("#expense-info").append(newRow);

                // Tambahkan event listener untuk tombol hapus
                $(".delete-expense").last().on("click", function() {
                    $(this).closest("tr").remove();
                });
            }

            function formatRupiah(angka) {
                var number_string = angka.toString();
                var sisa = number_string.length % 3;
                var rupiah = number_string.substr(0, sisa);
                var ribuan = number_string.substr(sisa).match(/\d{3}/g);

                if (ribuan) {
                    var separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                return rupiah;
            }
        });
    </script>
    <link rel="stylesheet" href="money.css">
    <script src="money.js" defer></script>
</body>
</html>
