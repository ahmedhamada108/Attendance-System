@if (session('success'))
                <div class="alert alert-success alert">
                    <ul>
                            <li>{{ session('success') }}</li>
                    </ul>
                </div>
@endif
@if (session('error'))
                <div class="alert alert-danger alert">
                    <ul>
                            <li>{{ session('error') }}</li>
                    </ul>
                </div>
@endif