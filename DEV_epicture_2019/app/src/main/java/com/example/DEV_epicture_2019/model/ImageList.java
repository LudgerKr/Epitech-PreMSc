package com.example.DEV_epicture_2019.model;

import com.google.gson.annotations.SerializedName;

import java.util.List;

public class ImageList {
    @SerializedName("data")
    private List<Image> images;

    public List<Image> getImages() {
        return images;
    }

    public void setImages(List<Image> images) {
        this.images = images;
    }
}