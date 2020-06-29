package com.example.DEV_epicture_2019;

import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;

import com.example.DEV_epicture_2019.adapter.UserImagesAdapter;
import com.example.DEV_epicture_2019.model.Image;
import com.example.DEV_epicture_2019.model.ImageList;

import java.util.ArrayList;
import java.util.List;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class UserImagesActivity extends AppCompatActivity {

    private RecyclerView recyclerView;

    private UserImagesAdapter userImagesAdapter;

    private List<Image> images = new ArrayList<>();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_user_images);

        recyclerView = findViewById(R.id.recyclerview);

        LinearLayoutManager linearLayoutManager = new LinearLayoutManager(UserImagesActivity.this);
        recyclerView.setLayoutManager(linearLayoutManager);

        userImagesAdapter = new UserImagesAdapter(UserImagesActivity.this, images);
        recyclerView.setAdapter(userImagesAdapter);

        getUserImages();
    }

    @Override
    public void onResume() {
        super.onResume();
        getUserImages();
        recyclerView.getAdapter().notifyDataSetChanged();
    }

    private void getUserImages() {
        images.clear();
        Call<ImageList> request = EpictureApp.getApi().getUserImages();
        request.enqueue(new Callback<ImageList>() {
            @Override
            public void onResponse(Call<ImageList> call, Response<ImageList> response) {
                if(response.isSuccessful()) {
                    for(Image image: response.body().getImages()){
                        images.add(image);
                    }
                    userImagesAdapter.notifyDataSetChanged();
                }
            }
            @Override
            public void onFailure(Call<ImageList> call, Throwable t) {
            }
        });
    }
}
