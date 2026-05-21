@extends('layouts.main')

@section('content')
    <!-- Form Edit Mode (Hanya tampil jika admin dan edit mode aktif) -->
    @if(isset($isAdmin) && $isAdmin && isset($editMode) && $editMode)
    <div class="content-box fade-in" style="background: #fff3cd; border-left: 5px solid #ffc107;">
        <h3 style="color: #856404; margin-bottom: 20px;">
            <i class="fas fa-edit"></i> Mode Edit Admin
        </h3>
        
        <form method="POST" action="/update-portfolio" id="editForm" enctype="multipart/form-data">
            @csrf
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <div>
                    <label style="display: block; margin-bottom: 5px; font-weight: 600;">Nama:</label>
                    <input type="text" name="name" value="{{ $name }}" 
                           style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                </div>
                
                <div>
                    <label style="display: block; margin-bottom: 5px; font-weight: 600;">Email:</label>
                    <input type="email" name="email" value="{{ $email }}" 
                           style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                </div>
            </div>
            
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 5px; font-weight: 600;">Deskripsi:</label>
                <textarea name="description" rows="3" 
                          style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">{{ $description }}</textarea>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <div>
                    <label style="display: block; margin-bottom: 5px; font-weight: 600;">Telepon:</label>
                    <input type="text" name="nomortelp" value="{{ $nomortelp }}" 
                           style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                </div>
                
                <div>
                    <label style="display: block; margin-bottom: 5px; font-weight: 600;">Lokasi:</label>
                    <input type="text" name="lokasi" value="{{ $lokasi }}" 
                           style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                </div>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <div>
                    <label style="display: block; margin-bottom: 5px; font-weight: 600;">Pendidikan:</label>
                    <input type="text" name="pendidikan" value="{{ $pendidikan }}" 
                           style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                </div>
                
                <div>
                    <label style="display: block; margin-bottom: 5px; font-weight: 600;">GitHub URL:</label>
                    <input type="url" name="github_url" value="{{ $github_url }}" 
                           style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                </div>
            </div>
            
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 5px; font-weight: 600;">Foto Profil:</label>
                <div style="display: grid; grid-template-columns: auto 1fr; gap: 15px; align-items: center;">
                    <img src="{{ $fotoprofil }}" alt="Foto profil saat ini"
                         style="width: 90px; height: 90px; object-fit: cover; border-radius: 50%; border: 3px solid #ffc107;">
                    <div>
                        <input type="file" name="fotoprofil_file" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
                               style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; background: white;">
                        <p style="font-size: 0.85rem; color: #666; margin-top: 5px;">
                            Format: jpeg, png, jpg, gif, webp. Maksimal 2MB. Kosongkan jika tidak ingin mengganti foto.
                        </p>
                    </div>
                </div>
                @error('fotoprofil_file')
                    <p style="color: #dc3545; font-size: 0.85rem; margin-top: 5px;">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 5px; font-weight: 600;">TikTok URL:</label>
                <input type="url" name="tiktok_url" value="{{ $tiktok_url }}" 
                       style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
            </div>
            
            <h4 style="margin-bottom: 15px;">Skills:</h4>
            <div id="skills-container">
                @foreach($skills as $index => $skill)
                <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 10px; margin-bottom: 10px;">
                    <input type="text" name="skills[name][]" value="{{ $skill['name'] }}" 
                           placeholder="Nama Skill" style="padding: 8px; border: 1px solid #ddd; border-radius: 5px;">
                    <input type="number" name="skills[percentage][]" value="{{ $skill['percentage'] }}" min="0" max="100"
                           placeholder="%" style="padding: 8px; border: 1px solid #ddd; border-radius: 5px;">
                </div>
                @endforeach
            </div>
            
            <button type="button" onclick="addSkill()" 
                    style="background: #17a2b8; color: white; border: none; padding: 8px 15px; 
                           border-radius: 5px; margin-bottom: 20px; cursor: pointer;">
                <i class="fas fa-plus"></i> Tambah Skill
            </button>
            
            <div style="display: flex; gap: 10px;">
                <button type="submit" 
                        style="background: #28a745; color: white; border: none; padding: 10px 20px; 
                               border-radius: 5px; cursor: pointer; flex: 1;">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
                
                <button type="button" onclick="document.getElementById('resetForm').submit()" 
                        style="background: #dc3545; color: white; border: none; padding: 10px 20px; 
                               border-radius: 5px; cursor: pointer;">
                    <i class="fas fa-undo"></i> Reset ke Default
                </button>
            </div>
        </form>
        
        <form method="POST" action="/reset-portfolio" id="resetForm" style="display: none;">
            @csrf
        </form>
    </div>
    @endif

    <!-- Profil dengan Animasi Floating -->
    <section class="content-box fade-in" id="about">
        <div class="profile-section">
            <div class="profile-image-container">
                <img src="{{ $fotoprofil }}"
                     alt="Foto Profil {{ $name }}" 
                     class="profile-image">
            </div>
            
            <div class="profile-info">
                <h2 class="title">Tentang Saya</h2>
                <div class="text-content">
                    <!-- Menggunakan variable untuk deskripsi -->
                    <p>{{ $description }}</p>
                    
                    <!-- Tombol dengan Animasi Hover -->
                    <div class="button-container">
                        <a href="{{ $github_url }}" 
                           class="route-button" 
                           target="_blank">
                            <i class="fab fa-github"></i>
                            <span>GitHub Project</span>
                        </a>
                        <a href="{{ $tiktok_url }}" 
                           class="route-button" 
                           style="background: linear-gradient(135deg, var(--tiktok) 0%, var(--tiktok-hover) 100%);"
                           target="_blank">
                            <i class="fab fa-tiktok"></i>
                            <span>TikTok Saya</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Skills dengan Progress Bar Animation -->
    <section class="content-box fade-in" id="skills">
        <h2 class="title">Keahlian Teknis</h2>
        <div class="skills-grid">
            @foreach($skills as $skill)
            <div class="skill-item">
                <div class="skill-name">
                    <span><i class="{{ $skill['icon'] }}"></i> {{ $skill['name'] }}</span>
                    @if(isset($isAdmin) && $isAdmin && isset($editMode) && $editMode)
                    <span style="color: var(--accent); font-weight: bold;">{{ $skill['percentage'] }}%</span>
                    @endif
                </div>
                <div class="skill-bar">
                    <div class="skill-level" 
                        style="animation-delay: {{ $skill['delay'] }}s; width: {{ $skill['percentage'] }}%;">
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Detail Profil -->
    <section class="content-box fade-in">
        <h2 class="title">Data Pribadi</h2>
        <div class="text-content">
            <ul>
                <li><strong>Nama Lengkap:</strong> {{ $name }}</li>
                <li><strong>Tanggal Lahir:</strong> {{ $tanggal_lahir }}</li>
                <li><strong>Jenis Kelamin:</strong> {{ $jenis_kelamin }}</li>
                <li><strong>Alamat:</strong> {{ $lokasi }}</li>
                <li><strong>Nomor Telepon:</strong> {{ $nomortelp }}</li>
                <li><strong>Email:</strong> {{ $email }}</li>
                <li><strong>Kewarganegaraan:</strong> {{ $kewarganegaraan }}</li>
            </ul>
        </div>
    </section>

    <section class="content-box fade-in">
        <h2 class="title">Pendidikan</h2>
        <div class="text-content">
            <ul>
                <li>SDIT Cordova</li>
                <li>SMPIT Cordova</li>
                <li>SMKTI Airlangga</li>
            </ul>
        </div>
    </section>

    <section class="content-box fade-in">
        <h2 class="title">Pengalaman</h2>
        <div class="text-content">
            <ul>
                @foreach(preg_split('/\r\n|\r|\n/', $pengalaman) as $item)
                    @if(trim($item) !== '')
                        <li>{{ $item }}</li>
                    @endif
                @endforeach
            </ul>
        </div>
    </section>

    <!-- Kontak dengan Animasi Icons -->
    <section class="content-box fade-in" id="contact">
        <h2 class="title">Kontak & Informasi</h2>
        <ul class="contact-list">
            <li>
                <div class="contact-icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <div>
                    <strong>Email:</strong> {{ $email }}
                </div>
            </li>
            <li>
                <div class="contact-icon">
                    <i class="fas fa-phone"></i>
                </div>
                <div>
                    <strong>Telepon:</strong> {{ $nomortelp }}
                </div>
            </li>
            <li>
                <div class="contact-icon">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <div>
                    <strong>Lokasi:</strong> {{ $lokasi }}
                </div>
            </li>
            <li>
                <div class="contact-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div>
                    <strong>Pendidikan:</strong> {{ $pendidikan }}
                </div>
            </li>
        </ul>
    </section>

    <script>
        function addSkill() {
            const container = document.getElementById('skills-container');
            const div = document.createElement('div');
            div.style.cssText = 'display: grid; grid-template-columns: 2fr 1fr; gap: 10px; margin-bottom: 10px;';
            div.innerHTML = `
                <input type="text" name="skills[name][]" placeholder="Nama Skill" 
                       style="padding: 8px; border: 1px solid #ddd; border-radius: 5px;">
                <input type="number" name="skills[percentage][]" placeholder="%" min="0" max="100"
                       style="padding: 8px; border: 1px solid #ddd; border-radius: 5px;">
            `;
            container.appendChild(div);
        }
    </script>
@endsection
