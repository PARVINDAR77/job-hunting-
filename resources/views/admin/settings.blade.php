@extends('admin.layouts.app')

@section('content')

<style>
    .settings-container {
        display: flex;
        gap: 30px;
        margin-top: 20px;
    }
    
    .settings-sidebar {
        width: 250px;
        flex-shrink: 0;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        padding: 20px 0;
        height: fit-content;
    }
    
    .settings-nav-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 24px;
        color: #4b5563;
        text-decoration: none;
        font-weight: 500;
        font-size: 15px;
        transition: all 0.2s;
        border-left: 3px solid transparent;
        cursor: pointer;
    }
    
    .settings-nav-item:hover, .settings-nav-item.active {
        background: #f3f4f6;
        color: #534ade;
    }
    
    .settings-nav-item.active {
        border-left-color: #534ade;
        background: #eef2ff;
    }
    
    .settings-content {
        flex: 1;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        padding: 30px;
    }
    
    .settings-section {
        display: none;
    }
    
    .settings-section.active {
        display: block;
    }
    
    .settings-section-title {
        font-size: 18px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 1px solid #e5e7eb;
    }
    
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }
    
    .form-group {
        display: flex;
        flex-direction: column;
        margin-bottom: 20px;
    }
    
    .form-group.full-width {
        grid-column: 1 / -1;
    }
    
    .form-group label {
        font-weight: 600;
        margin-bottom: 8px;
        color: #374151;
        font-size: 14px;
    }
    
    .form-control {
        padding: 12px 15px;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        font-size: 15px;
        transition: all 0.3s ease;
        background: #fdfdfd;
        width: 100%;
        box-sizing: border-box;
    }
    
    .form-control:focus {
        border-color: #534ade;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(83, 74, 222, 0.15);
        outline: none;
    }
    
    .btn-submit {
        background: #534ade;
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.3s;
        font-size: 15px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-top: 20px;
    }
    
    .btn-submit:hover {
        background: #4338ca;
    }

    .analytics-label {
        color: #534ade;
        font-weight: 700;
        font-size: 11px;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 8px;
        display: block;
    }
</style>

<div>
    <span class="analytics-label">CONFIGURATION</span>
    <h3 style="font-size: 22px; color: #111827; margin: 0 0 5px 0; font-weight: 700;">Site Settings</h3>
    <p style="color: #6b7280; margin: 0; font-size: 14px;">Manage your application's global configuration.</p>
</div>

@if(session('success'))
<div style="background: #d1fae5; color: #065f46; padding: 12px 20px; border-radius: 8px; margin-top: 20px; font-weight: 500; font-size: 14px;">
    <i class="fas fa-check-circle" style="margin-right: 8px;"></i> {{ session('success') }}
</div>
@endif

<form action="{{ route('admin.settings.update') }}" method="POST">
    @csrf
    <div class="settings-container">
        
        <!-- Sidebar Navigation -->
        <div class="settings-sidebar">
            <div class="settings-nav-item active" onclick="switchTab('general', this)">
                <i class="fas fa-sliders-h"></i> General Settings
            </div>
            <div class="settings-nav-item" onclick="switchTab('contact', this)">
                <i class="fas fa-address-book"></i> Contact Info
            </div>
            <div class="settings-nav-item" onclick="switchTab('social', this)">
                <i class="fas fa-share-alt"></i> Social Links
            </div>
        </div>

        <!-- Settings Content Areas -->
        <div class="settings-content">
            
            <!-- General Settings -->
            <div id="tab-general" class="settings-section active">
                <div class="settings-section-title">General Settings</div>
                <div class="form-grid">
                    <div class="form-group full-width">
                        <label>Site Name</label>
                        <input type="text" name="site_name" class="form-control" value="{{ $settings['site_name'] ?? 'JobFinder' }}">
                    </div>
                    <div class="form-group full-width">
                        <label>Site Description</label>
                        <textarea name="site_description" class="form-control" rows="3">{{ $settings['site_description'] ?? 'Find your next career opportunity today.' }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Default Currency</label>
                        <select name="currency" class="form-control">
                            <option value="USD" {{ ($settings['currency'] ?? '') == 'USD' ? 'selected' : '' }}>USD ($)</option>
                            <option value="EUR" {{ ($settings['currency'] ?? '') == 'EUR' ? 'selected' : '' }}>EUR (€)</option>
                            <option value="GBP" {{ ($settings['currency'] ?? '') == 'GBP' ? 'selected' : '' }}>GBP (£)</option>
                            <option value="INR" {{ ($settings['currency'] ?? '') == 'INR' ? 'selected' : '' }}>INR (₹)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Timezone</label>
                        <input type="text" name="timezone" class="form-control" value="{{ $settings['timezone'] ?? 'UTC' }}">
                    </div>
                </div>
            </div>

            <!-- Contact Settings -->
            <div id="tab-contact" class="settings-section">
                <div class="settings-section-title">Contact Information</div>
                <div class="form-grid">
                    <div class="form-group">
                        <label>Support Email</label>
                        <input type="email" name="contact_email" class="form-control" value="{{ $settings['contact_email'] ?? 'support@jobfinder.com' }}">
                    </div>
                    <div class="form-group">
                        <label>Contact Phone</label>
                        <input type="text" name="contact_phone" class="form-control" value="{{ $settings['contact_phone'] ?? '+1 234 567 8900' }}">
                    </div>
                    <div class="form-group full-width">
                        <label>Office Address</label>
                        <textarea name="contact_address" class="form-control" rows="3">{{ $settings['contact_address'] ?? '123 Business Avenue, Tech District, NY 10001' }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Social Settings -->
            <div id="tab-social" class="settings-section">
                <div class="settings-section-title">Social Media Links</div>
                <div class="form-grid">
                    <div class="form-group">
                        <label>Facebook URL</label>
                        <input type="url" name="social_facebook" class="form-control" value="{{ $settings['social_facebook'] ?? 'https://facebook.com/' }}">
                    </div>
                    <div class="form-group">
                        <label>Twitter/X URL</label>
                        <input type="url" name="social_twitter" class="form-control" value="{{ $settings['social_twitter'] ?? 'https://twitter.com/' }}">
                    </div>
                    <div class="form-group">
                        <label>LinkedIn URL</label>
                        <input type="url" name="social_linkedin" class="form-control" value="{{ $settings['social_linkedin'] ?? 'https://linkedin.com/' }}">
                    </div>
                    <div class="form-group">
                        <label>Instagram URL</label>
                        <input type="url" name="social_instagram" class="form-control" value="{{ $settings['social_instagram'] ?? 'https://instagram.com/' }}">
                    </div>
                </div>
            </div>

            <button type="submit" class="btn-submit">
                <i class="fas fa-save"></i> Save Settings
            </button>
            
        </div>
    </div>
</form>

<script>
    function switchTab(tabId, element) {
        // Hide all sections
        document.querySelectorAll('.settings-section').forEach(el => el.classList.remove('active'));
        
        // Remove active class from all nav items
        document.querySelectorAll('.settings-nav-item').forEach(el => el.classList.remove('active'));
        
        // Show target section
        document.getElementById('tab-' + tabId).classList.add('active');
        
        // Set clicked nav item as active
        element.classList.add('active');
    }
</script>

@endsection
