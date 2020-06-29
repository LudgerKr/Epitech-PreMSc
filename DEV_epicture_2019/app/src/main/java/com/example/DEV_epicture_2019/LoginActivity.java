package com.example.DEV_epicture_2019;

import android.content.Intent;
import android.net.Uri;
import android.os.Bundle;
import android.os.StrictMode;
import android.support.v7.app.AppCompatActivity;

import com.example.DEV_epicture_2019.model.Profile;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class LoginActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        StrictMode.ThreadPolicy policy = new StrictMode.ThreadPolicy.Builder().permitAll().build();
        StrictMode.setThreadPolicy(policy);

        Uri uri = getIntent().getData();

        if (uri != null && uri.toString().startsWith(ApiConstants.redirectUri)) {
            String[] paramList = uri.toString().split("&");

            String access_token     = paramList[0].substring(paramList[0].indexOf("=") + 1);
            String refresh_token    = paramList[3].substring(paramList[3].indexOf("=") + 1);

            EpictureApp.getInstance().setTokens(access_token, refresh_token);

            getUserProfile();

            Intent i = new Intent(getBaseContext(), DashboardActivity.class);
            startActivity(i);
            finish();
        } else {
            Intent intent = new Intent(Intent.ACTION_VIEW, Uri.parse("https://api.imgur.com/oauth2/authorize" + "?client_id=" + ApiConstants.clientId + "&response_type=token"));
            startActivity(intent);
        }
    }

    private void getUserProfile() {
        Call<Profile> request = EpictureApp.getApi().getUserProfile();
        request.enqueue(new Callback<Profile>() {
            @Override
            public void onResponse(Call<Profile> call, Response<Profile> response) {
                if(response.isSuccessful()) {
                    String userEmail    = response.body().getProfil().getEmail();
                    String userName     = response.body().getProfil().getUsername();
                    Boolean showMature  = response.body().getProfil().isShowMature();

                    EpictureApp.getInstance().setProfil(userName, userEmail, showMature);

                }
            }
            @Override
            public void onFailure(Call<Profile> call, Throwable t) {
                    System.out.println("Error");
            }
        });
    }
}
