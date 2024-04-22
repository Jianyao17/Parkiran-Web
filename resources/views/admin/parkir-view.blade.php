<div class="m-3 my4">
    <h2 class="text-start">Parkiran</h2>
    <p>History Parkir Kendaraan</p>

    <div class="py-3 d-flex justify-content-start position-sticky sticky-searchbar">
        <select class="flex-grow-0 form-select bg-body-tertiary" id="timeFilter">
            <option value="hari" selected>Hari Ini</option>
            <option value="minggu">Minggu Ini</option>
            <option value="bulan">Bulan Ini</option>
        </select>
        <div class="col-8 px-2">
            <input type="search" class="form-control" placeholder="Cari History Parkir Kendaraan">
        </div>
        <select class="flex-grow-0 form-select bg-body-tertiary" id="statusFilter">
            <option value="active" selected>Active</option>
            <option value="finished">Finished</option>
        </select>
    </div>

    {{-- Parkiran Table --}}
    <table class="table table-hover">
        <thead class="table-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Plat Kendaraan</th>
                <th scope="col">Tempat Parkir</th>
                <th scope="col">Waktu Masuk</th>
                <th scope="col">Waktu Keluar</th>
                <th scope="col">Biaya (Rp)</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <tr>
                <th class="align-middle" scope="row">1</th>
                <td class="align-middle fw-bold">L532</td>
                <td class="align-middle">Lantai-1 | A17</td>
                <td class="align-middle">17/02/2024 - 06:43</td>
                <td class="align-middle"></td>
                <td class="align-middle">Rp 20.000</td>
                <td class="align-middle fw-medium text-success">
                    <i class="bi bi-square-fill me-1"></i>
                    Active
                </td>
            </tr>
            <tr>
                <th class="align-middle" scope="row">1</th>
                <td class="align-middle fw-bold">L214</td>
                <td class="align-middle">Lantai-1 | A4</td>
                <td class="align-middle">23/02/2024 - 06:43</td>
                <td class="align-middle">23/02/2024 - 10:21</td>
                <td class="align-middle">Rp 20.000</td>
                <td class="align-middle fw-medium text-primary">
                    <i class="bi bi-square-fill me-1"></i>
                    Finished
                </td>
            </tr>
            <tr>
                <th class="align-middle" scope="row">2</th>
                <td class="align-middle fw-bold">K124</td>
                <td class="align-middle">Lantai-2 | B2</td>
                <td class="align-middle">28/05/2024 - 08:53</td>
                <td class="align-middle">28/05/2024 - 13:28</td>
                <td class="align-middle">Rp 20.000</td>
                <td class="align-middle fw-medium text-primary">
                    <i class="bi bi-square-fill me-1"></i>
                    Finished
                </td>
            </tr>
            <tr>
                <th class="align-middle" scope="row">2</th>
                <td class="align-middle fw-bold">K124</td>
                <td class="align-middle">Lantai-2 | B2</td>
                <td class="align-middle">28/05/2024 - 08:53</td>
                <td class="align-middle">28/05/2024 - 13:28</td>
                <td class="align-middle">Rp 20.000</td>
                <td class="align-middle fw-medium text-primary">
                    <i class="bi bi-square-fill me-1"></i>
                    Finished
                </td>
            </tr>
            <tr>
                <th class="align-middle" scope="row">2</th>
                <td class="align-middle fw-bold">K124</td>
                <td class="align-middle">Lantai-2 | B2</td>
                <td class="align-middle">28/05/2024 - 08:53</td>
                <td class="align-middle">28/05/2024 - 13:28</td>
                <td class="align-middle">Rp 20.000</td>
                <td class="align-middle fw-medium text-primary">
                    <i class="bi bi-square-fill me-1"></i>
                    Finished
                </td>
            </tr>
            <tr>
                <th class="align-middle" scope="row">2</th>
                <td class="align-middle fw-bold">K124</td>
                <td class="align-middle">Lantai-2 | B2</td>
                <td class="align-middle">28/05/2024 - 08:53</td>
                <td class="align-middle">28/05/2024 - 13:28</td>
                <td class="align-middle">Rp 20.000</td>
                <td class="align-middle fw-medium text-primary">
                    <i class="bi bi-square-fill me-1"></i>
                    Finished
                </td>
            </tr>
            <tr>
                <th class="align-middle" scope="row">2</th>
                <td class="align-middle fw-bold">K124</td>
                <td class="align-middle">Lantai-2 | B2</td>
                <td class="align-middle">28/05/2024 - 08:53</td>
                <td class="align-middle">28/05/2024 - 13:28</td>
                <td class="align-middle">Rp 20.000</td>
                <td class="align-middle fw-medium text-primary">
                    <i class="bi bi-square-fill me-1"></i>
                    Finished
                </td>
            </tr>
            <tr>
                <th class="align-middle" scope="row">2</th>
                <td class="align-middle fw-bold">K124</td>
                <td class="align-middle">Lantai-2 | B2</td>
                <td class="align-middle">28/05/2024 - 08:53</td>
                <td class="align-middle">28/05/2024 - 13:28</td>
                <td class="align-middle">Rp 20.000</td>
                <td class="align-middle fw-medium text-primary">
                    <i class="bi bi-square-fill me-1"></i>
                    Finished
                </td>
            </tr>
            <tr>
                <th class="align-middle" scope="row">2</th>
                <td class="align-middle fw-bold">K124</td>
                <td class="align-middle">Lantai-2 | B2</td>
                <td class="align-middle">28/05/2024 - 08:53</td>
                <td class="align-middle">28/05/2024 - 13:28</td>
                <td class="align-middle">Rp 20.000</td>
                <td class="align-middle fw-medium text-primary">
                    <i class="bi bi-square-fill me-1"></i>
                    Finished
                </td>
            </tr>
            <tr>
                <th class="align-middle" scope="row">2</th>
                <td class="align-middle fw-bold">K124</td>
                <td class="align-middle">Lantai-2 | B2</td>
                <td class="align-middle">28/05/2024 - 08:53</td>
                <td class="align-middle">28/05/2024 - 13:28</td>
                <td class="align-middle">Rp 20.000</td>
                <td class="align-middle fw-medium text-primary">
                    <i class="bi bi-square-fill me-1"></i>
                    Finished
                </td>
            </tr>
            <tr>
                <th class="align-middle" scope="row">2</th>
                <td class="align-middle fw-bold">K124</td>
                <td class="align-middle">Lantai-2 | B2</td>
                <td class="align-middle">28/05/2024 - 08:53</td>
                <td class="align-middle">28/05/2024 - 13:28</td>
                <td class="align-middle">Rp 20.000</td>
                <td class="align-middle fw-medium text-primary">
                    <i class="bi bi-square-fill me-1"></i>
                    Finished
                </td>
            </tr>
            <tr>
                <th class="align-middle" scope="row">2</th>
                <td class="align-middle fw-bold">K124</td>
                <td class="align-middle">Lantai-2 | B2</td>
                <td class="align-middle">28/05/2024 - 08:53</td>
                <td class="align-middle">28/05/2024 - 13:28</td>
                <td class="align-middle">Rp 20.000</td>
                <td class="align-middle fw-medium text-primary">
                    <i class="bi bi-square-fill me-1"></i>
                    Finished
                </td>
            </tr>
            <tr>
                <th class="align-middle" scope="row">2</th>
                <td class="align-middle fw-bold">K124</td>
                <td class="align-middle">Lantai-2 | B2</td>
                <td class="align-middle">28/05/2024 - 08:53</td>
                <td class="align-middle">28/05/2024 - 13:28</td>
                <td class="align-middle">Rp 20.000</td>
                <td class="align-middle fw-medium text-primary">
                    <i class="bi bi-square-fill me-1"></i>
                    Finished
                </td>
            </tr>
            <tr>
                <th class="align-middle" scope="row">2</th>
                <td class="align-middle fw-bold">K124</td>
                <td class="align-middle">Lantai-2 | B2</td>
                <td class="align-middle">28/05/2024 - 08:53</td>
                <td class="align-middle">28/05/2024 - 13:28</td>
                <td class="align-middle">Rp 20.000</td>
                <td class="align-middle fw-medium text-primary">
                    <i class="bi bi-square-fill me-1"></i>
                    Finished
                </td>
            </tr>
            <tr>
                <th class="align-middle" scope="row">2</th>
                <td class="align-middle fw-bold">K124</td>
                <td class="align-middle">Lantai-2 | B2</td>
                <td class="align-middle">28/05/2024 - 08:53</td>
                <td class="align-middle">28/05/2024 - 13:28</td>
                <td class="align-middle">Rp 20.000</td>
                <td class="align-middle fw-medium text-primary">
                    <i class="bi bi-square-fill me-1"></i>
                    Finished
                </td>
            </tr>
            <tr>
                <th class="align-middle" scope="row">2</th>
                <td class="align-middle fw-bold">K124</td>
                <td class="align-middle">Lantai-2 | B2</td>
                <td class="align-middle">28/05/2024 - 08:53</td>
                <td class="align-middle">28/05/2024 - 13:28</td>
                <td class="align-middle">Rp 20.000</td>
                <td class="align-middle fw-medium text-primary">
                    <i class="bi bi-square-fill me-1"></i>
                    Finished
                </td>
            </tr>
            <tr>
                <th class="align-middle" scope="row">2</th>
                <td class="align-middle fw-bold">K124</td>
                <td class="align-middle">Lantai-2 | B2</td>
                <td class="align-middle">28/05/2024 - 08:53</td>
                <td class="align-middle">28/05/2024 - 13:28</td>
                <td class="align-middle">Rp 20.000</td>
                <td class="align-middle fw-medium text-primary">
                    <i class="bi bi-square-fill me-1"></i>
                    Finished
                </td>
            </tr>
        </tbody>
    </table>
</div>
