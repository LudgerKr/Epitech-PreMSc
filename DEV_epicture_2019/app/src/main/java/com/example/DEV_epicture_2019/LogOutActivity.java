package com.example.DEV_epicture_2019;

import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.os.Handler;
import android.support.v7.app.AppCompatActivity;
import android.widget.ProgressBar;
import android.widget.TextView;

public class LogOutActivity extends AppCompatActivity {

    private TextView mGood_Bye_Message;
    private ProgressBar mProgressBar;

    SharedPreferences sharedPreferences;

    public static final String KEY_EPICTURE_PREF    = "KEY_EPICTURE_PREF";
    public static final String KEY_USER_NAME        = "KEY_USER_NAME";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_log_out);

        sharedPreferences   = getBaseContext().getSharedPreferences(KEY_EPICTURE_PREF, 0);

        mGood_Bye_Message   = findViewById(R.id.Good_Bye_TextView);
        mProgressBar        = findViewById(R.id.progress_bar);
        String UserName     = sharedPreferences.getString(KEY_USER_NAME, null);

        mGood_Bye_Message.setText("See you soon " + UserName + ".");

        EpictureApp.getInstance().setTokens(null, null);
        EpictureApp.getInstance().setProfil(null, null, false);

        new Handler().postDelayed(new Runnable() {
            @Override
            public void run() {
                Intent i = new Intent(getBaseContext(), DashboardActivity.class);
                startActivity(i);
                finish();
            }
        }, 2000);
    }
}
