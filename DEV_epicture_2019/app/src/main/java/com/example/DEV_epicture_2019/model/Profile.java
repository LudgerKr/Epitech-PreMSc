package com.example.DEV_epicture_2019.model;

import com.google.gson.annotations.SerializedName;


public class Profile {
    @SerializedName("data")
    private Profile Profil;
    @SerializedName("account_url")
    private String username;
    @SerializedName("email")
    private String email;
    @SerializedName("show_mature")
    private boolean showMature;

    public Profile getProfil() {
        return Profil;
    }

    public void setProfil(Profile profil) {
        Profil = profil;
    }

    public String getUsername() {
        return username;
    }

    public void setUsername(String username) {
        this.username = username;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public boolean isShowMature() {
        return showMature;
    }

    public void setShowMature(boolean showMature) {
        this.showMature = showMature;
    }
}