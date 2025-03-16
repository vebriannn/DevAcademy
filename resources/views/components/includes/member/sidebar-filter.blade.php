<!-- Sidebar -->
<div class="col-md-3 p-0">
    <div class="col-md-9 ms-5">
        <div class="sidebar">
            <div class="filter-kelas">
                <div class="filter-header d-flex gap-3 justify-content-center align-items-center">
                    <img src="{{ asset('devacademy/components/member/img/hugeicons_nano-technology.png') }}" class="filter-logo" alt="...">
                    <h5 class="fw-bold d-inline">Filter Kelas</h5>
                </div>
                <hr>
                    <ul>
                        <li>
                            <input id="filter-kelas-semua" name="filter-kelas" value="semua" checked="checked" type="radio" onchange="this.form.submit()" {{ request('filter-kelas') == 'semua' ? 'checked' : '' }}>
                            <label for="filter-kelas-semua">
                                Semua
                            </label>
                        </li>
                        <li>
                            <input id="filter-kelas-uiux" name="filter-kelas" value="UI/UX Designer" type="radio" onchange="this.form.submit()" {{ request('filter-kelas') == 'UI/UX Designer' ? 'checked' : '' }}>
                            <label for="filter-kelas-uiux">
                                UI/UX Designer
                            </label>
                        </li>
                        <li>
                            <input id="filter-kelas-frontend" name="filter-kelas" value="Frontend Developer" type="radio" onchange="this.form.submit()" {{ request('filter-kelas') == 'Frontend Developer' ? 'checked' : '' }}>
                            <label for="filter-kelas-frontend">
                                Frontend Developer
                            </label>
                        </li>
                        <li>
                            <input id="filter-kelas-backend" name="filter-kelas" value="Backend Developer" type="radio" onchange="this.form.submit()" {{ request('filter-kelas') == 'Backend Developer' ? 'checked' : '' }}>
                            <label for="filter-kelas-backend">
                                Backend Developer
                            </label>
                        </li>
                        <li>
                            <input id="filter-kelas-wordpress" name="filter-kelas" value="Wordpress Developer" type="radio" onchange="this.form.submit()" {{ request('filter-kelas') == 'Wordpress Developer' ? 'checked' : '' }}>
                            <label for="filter-kelas-wordpress">
                                Wordpress Developer
                            </label>
                        </li>
                        <li>
                            <input id="filter-kelas-graphics" name="filter-kelas" value="Graphics Designer" type="radio" onchange="this.form.submit()" {{ request('filter-kelas') == 'Graphics Designer' ? 'checked' : '' }}>
                            <label for="filter-kelas-graphics">
                                Graphics Designer
                            </label>
                        </li>
                        <li>
                            <input id="filter-kelas-fullstack" name="filter-kelas" value="Fullstack Developer" type="radio" onchange="this.form.submit()" {{ request('filter-kelas') == 'Fullstack Developer' ? 'checked' : '' }}>
                            <label for="filter-kelas-fullstack">
                                Fullstack Developer
                            </label>
                        </li>
                    </ul>
                </form>

            </div>
        </div>
    </div>
</div>
