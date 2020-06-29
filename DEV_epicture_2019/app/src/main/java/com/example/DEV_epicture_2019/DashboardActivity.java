package com.example.DEV_epicture_2019;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;

import java.util.ArrayList;
import java.util.List;

public class DashboardActivity extends AppCompatActivity implements View.OnClickListener {

    private List<Button> buttons;
    private static final int[] BUTTON_IDS = {
            R.id.auth_btn,
            R.id.search_btn,
            R.id.upload_btn,
            R.id.image_btn,
            R.id.fav_btn,
            R.id.profile_btn,
            R.id.log_out_btn,
    };

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_dashboard);

        buttons = new ArrayList<>(BUTTON_IDS.length);
        for(int id : BUTTON_IDS) {
            Button button = findViewById(id);
            if (EpictureApp.getInstance().getAccessToken() != null && id == R.id.auth_btn)
                button.setEnabled(false);
            if (EpictureApp.getInstance().getAccessToken() == null && id != R.id.auth_btn)
                button.setEnabled(false);

            button.setOnClickListener(this);
            buttons.add(button);
        }
    }

    @Override
    public void onClick(View v) {

        Intent myIntent;

        switch (v.getId()) {

            case R.id.auth_btn:
                myIntent = new Intent(getBaseContext(), LoginActivity.class);
                startActivity(myIntent);
                finish();
                break;

            case R.id.log_out_btn:
                myIntent = new Intent(getBaseContext(), LogOutActivity.class);
                startActivity(myIntent);
                finish();
                break;

            case R.id.search_btn:
                myIntent = new Intent(getBaseContext(), SearchActivity.class);
                startActivity(myIntent);
                break;

            case R.id.upload_btn:
                myIntent = new Intent(getBaseContext(), UploadActivity.class);
                startActivity(myIntent);
                break;

            case R.id.image_btn:
                myIntent = new Intent(getBaseContext(), UserImagesActivity.class);
                startActivity(myIntent);
                break;

            case R.id.fav_btn:
                myIntent = new Intent(getBaseContext(), UserFavoritesActivity.class);
                startActivity(myIntent);
                break;

            case R.id.profile_btn:
                myIntent = new Intent(getBaseContext(), UserProfileActivity.class);
                startActivity(myIntent);
                break;

            default:
                break;
        }

    }
}
