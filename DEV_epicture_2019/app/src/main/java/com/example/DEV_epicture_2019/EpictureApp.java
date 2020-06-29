package com.example.DEV_epicture_2019;

import android.app.Application;
import android.content.SharedPreferences;

public class EpictureApp extends Application {

    private static EpictureApp instance         = null;
    private static ApiInterface apiInterface    = null;
    private static String accessToken           = null;

    public static final String KEY_EPICTURE_PREF    = "KEY_EPICTURE_PREF";
    public static final String KEY_ACCESS_TOKEN     = "KEY_ACCESS_TOKEN";
    public static final String KEY_REFRESH_TOKEN    = "KEY_REFRESH_TOKEN";

    public static final String KEY_USER_NAME    = "KEY_USER_NAME";
    public static final String KEY_USER_EMAIL   = "KEY_USER_EMAIL";
    public static final String KEY_SHOW_MATURE  = "KEY_SHOW_MATURE";

    @Override
    public void onCreate(){
        super.onCreate();

        instance = this;
        apiInterface = ServiceGenerator.createService(ApiInterface.class);
        retrieveTokensFromSharedPrefs();
    }

    public static EpictureApp getInstance() {
        return instance;
    }

    public static ApiInterface getApi() {
        return apiInterface;
    }

    private void retrieveTokensFromSharedPrefs() {
        SharedPreferences pref = getApplicationContext().getSharedPreferences(KEY_EPICTURE_PREF, 0);

        accessToken = pref.getString(KEY_ACCESS_TOKEN, null);
    }

    public void setTokens(String access_token, String refresh_token) {
        SharedPreferences pref          = getApplicationContext().getSharedPreferences(KEY_EPICTURE_PREF, 0);
        SharedPreferences.Editor editor = pref.edit();

        accessToken = access_token;

        editor.putString(KEY_ACCESS_TOKEN, access_token);
        editor.putString(KEY_REFRESH_TOKEN, refresh_token);
        editor.apply();
    }

    public void setProfil(String userName, String userEmail, boolean showMature) {
        SharedPreferences pref          = getApplicationContext().getSharedPreferences(KEY_EPICTURE_PREF, 0);
        SharedPreferences.Editor editor = pref.edit();

        editor.putString(KEY_USER_NAME, userName);
        editor.putString(KEY_USER_EMAIL, userEmail);
        editor.putBoolean(KEY_SHOW_MATURE, showMature);
        editor.apply();
    }

    public String getAccessToken() {
        return accessToken;
    }
}
