package com.example.DEV_epicture_2019;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import okhttp3.ResponseBody;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class EditImageActivity extends AppCompatActivity {

    private EditText image_title;
    private Button edit_btn, delete_btn;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_edit_image);

        image_title = findViewById(R.id.image_title);
        edit_btn    = findViewById(R.id.edit_btn);
        delete_btn  = findViewById(R.id.delete_btn);

        Intent aIntent          = getIntent();
        final String image_id   = aIntent.getStringExtra("image_id");

        edit_btn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                updateImage(image_id, image_title.getText().toString());
            }
        });

        delete_btn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                deleteImage(image_id);
            }
        });
    }

    private void updateImage(String image_id, String image_title) {
        Call<ResponseBody> request = EpictureApp.getApi().updateImage(image_id, image_title);
        request.enqueue(new Callback<ResponseBody>() {
            @Override
            public void onResponse(Call<ResponseBody> call, Response<ResponseBody> response) {
                if (response.isSuccessful()) {
                    Toast.makeText(EditImageActivity.this, "Image title edited !", Toast.LENGTH_SHORT).show();
                    finish();
                }
            }

            @Override
            public void onFailure(Call<ResponseBody> call, Throwable t) {
                Toast.makeText(EditImageActivity.this, "Network error", Toast.LENGTH_SHORT).show();
                t.printStackTrace();
            }
        });
    }

    private void deleteImage(String image_id) {
        Call<ResponseBody> request = EpictureApp.getApi().deleteImage(image_id);
        request.enqueue(new Callback<ResponseBody>() {
            @Override
            public void onResponse(Call<ResponseBody> call, Response<ResponseBody> response) {
                if (response.isSuccessful()) {
                    Toast.makeText(EditImageActivity.this, "Image deleted !", Toast.LENGTH_SHORT).show();
                    finish();
                }
            }

            @Override
            public void onFailure(Call<ResponseBody> call, Throwable t) {
                Toast.makeText(EditImageActivity.this, "Network error", Toast.LENGTH_SHORT).show();
                t.printStackTrace();
            }
        });
    }
}
