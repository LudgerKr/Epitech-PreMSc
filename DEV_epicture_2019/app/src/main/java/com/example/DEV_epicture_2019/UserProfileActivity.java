package com.example.DEV_epicture_2019;

import android.content.DialogInterface;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.RecyclerView;
import android.text.Editable;
import android.text.TextWatcher;
import android.view.View;
import android.widget.Button;
import android.widget.CompoundButton;
import android.widget.EditText;
import android.widget.Switch;
import android.widget.TextView;
import android.widget.Toast;

import com.example.DEV_epicture_2019.model.Profile;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class UserProfileActivity extends AppCompatActivity implements View.OnClickListener  {

    private RecyclerView recyclerView;

    private String username;
    private Boolean showMature;
    private String email;

    private Boolean changeUserName  = false;
    private Boolean changeUserEmail = false;
    private Boolean changeSwitchMatureState = false;

    private TextView mTextProfile;
    private Button mBtnSave;
    private Button mBtnCancel;
    private EditText mEditEmail;
    private EditText mEditUserName;
    private Switch mSwitchMature;

    SharedPreferences sharedPreferences;

    public static final String KEY_EPICTURE_PREF    = "KEY_EPICTURE_PREF";
    public static final String KEY_USER_NAME        = "KEY_USER_NAME";
    public static final String KEY_USER_EMAIL       = "KEY_USER_EMAIL";
    public static final String KEY_SHOW_MATURE      = "KEY_SHOW_MATURE";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_profile);

         mTextProfile   = findViewById(R.id.txtProfile);
         mBtnSave       = findViewById(R.id.btnSave);
         mBtnCancel     = findViewById(R.id.btnCancel);
         mEditEmail     = findViewById(R.id.editEmail);
         mEditUserName  = findViewById(R.id.editUsername);
         mSwitchMature  = findViewById(R.id.switchMature);

         mBtnCancel.setTag(0);
         mBtnSave.setTag(1);
         mBtnCancel.setOnClickListener(this);
         mBtnSave.setOnClickListener(this);

        sharedPreferences = getBaseContext().getSharedPreferences(KEY_EPICTURE_PREF, 0);

        recyclerView = findViewById(R.id.recyclerview);

        getUserProfile(sharedPreferences);
        fillInputs();

        mBtnSave.setEnabled(false);

        mEditEmail.addTextChangedListener(new TextWatcher() {
            @Override
            public void beforeTextChanged(CharSequence charSequence, int i, int i1, int i2) {}
            @Override
            public void onTextChanged(CharSequence charSequence, int i, int i1, int i2) {
                //TODO : change here setEneble to true to active name transformation
                mBtnSave.setEnabled(false);
                setChangeUserEmail(true);
            }
            @Override
            public void afterTextChanged(Editable editable) {}
        });

        mEditUserName.addTextChangedListener(new TextWatcher() {

            @Override
            public void beforeTextChanged(CharSequence charSequence, int i, int i1, int i2) {}
            @Override
            public void onTextChanged(CharSequence charSequence, int i, int i1, int i2) {
                //TODO : change here setEneble to true to active name transformation
                mBtnSave.setEnabled(false);
                setChangeUserEmail(true);
            }

            @Override
            public void afterTextChanged(Editable editable) {

            }
        });

        mSwitchMature.setOnCheckedChangeListener(new CompoundButton.OnCheckedChangeListener() {
            @Override
            public void onCheckedChanged(CompoundButton compoundButton, boolean b) {
                mBtnSave.setEnabled(true);
                setChangeSwitchMatureState(true);
            }
        });

    }

   private void getUserProfile(SharedPreferences sharedPreferences) {
       setUsername(sharedPreferences.getString(KEY_USER_NAME, null));
       setShowMature(sharedPreferences.getBoolean(KEY_SHOW_MATURE, false));
       setEmail(sharedPreferences.getString(KEY_USER_EMAIL, null));
   }

    public void fillInputs() {
        this.mEditUserName.setText(getUsername());
        this.mEditEmail.setText(getEmail());
        this.mSwitchMature.setChecked(getShowMature());
    }

    @Override
    public void onClick(View view) {
        int btnIndex = (int) view.getTag();

        switch (btnIndex) {
            case 0:
                finish();
                break;
            case 1:
                areYouSure();
                break;
        }
    }

    public void areYouSure() {
        AlertDialog.Builder builder = new AlertDialog.Builder(this);

        builder.setTitle("Do you realy want to change your informations ?")
                .setMessage("Are you sure ?")
                .setPositiveButton("OK", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                        updateUserInformations();
                    }
                })
                .setNegativeButton("Cancel", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                        finish();
                    }
                })
                .create()
                .show();
    }

    public void updateUserInformations() {
        if (getChangeUserName()) {
            //TODO : impelement function to upload new informations
        }
        if (getChangeUserEmail()) {
            //TODO : impelement function to upload new information
        }
        if (getChangeSwitchMatureState()) {
            setShowMature(mSwitchMature.isChecked() ? true : false);
            setShowMatureUpload(mSwitchMature.isChecked() ? true : false);
        }
    }

    private void setShowMatureUpload(Boolean showMature) {
        Call<Profile> request = EpictureApp.getApi().setShowMatureUserProfile(showMature);
        request.enqueue(new Callback<Profile>() {
            @Override
            public void onResponse(Call<Profile> call, Response<Profile> response) {
                if(response.isSuccessful()) {
                    Toast.makeText(UserProfileActivity.this, "ProfileUpdated !", Toast.LENGTH_SHORT).show();
                    //TODO : Upload de l'info ok, il faut recharger sharedPreferences avec les nouvelle valeurs
                    //SharedPreferences pref = getApplicationContext().getSharedPreferences(KEY_EPICTURE_PREF, 0);
                    //SharedPreferences.Editor editor = pref.edit();
                    //editor.putBoolean(KEY_SHOW_MATURE, getShowMature());
                    //editor.apply();

                }
            }
            @Override
            public void onFailure(Call<Profile> call, Throwable t) {
                System.out.println("Error");
            }
        });
    }

    public String getUsername() {
        return username;
    }

    public void setUsername(String username) {
        this.username = username;
    }

    public Boolean getShowMature() {
        return showMature;
    }

    public void setShowMature(Boolean showMature) {
        this.showMature = showMature;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public Boolean getChangeUserName() {
        return changeUserName;
    }

    public void setChangeUserName(Boolean changeUserName) {
        this.changeUserName = changeUserName;
    }

    public Boolean getChangeUserEmail() {
        return changeUserEmail;
    }

    public void setChangeUserEmail(Boolean changeUserEmail) {
        this.changeUserEmail = changeUserEmail;
    }

    public Boolean getChangeSwitchMatureState() {
        return changeSwitchMatureState;
    }

    public void setChangeSwitchMatureState(Boolean changeSwitchMatureState) {
        this.changeSwitchMatureState = changeSwitchMatureState;
    }

    @Override
    public String toString() {
        return "UserProfileActivity{" +
                "username='" + username + '\'' +
                ", showMature=" + showMature +
                ", email='" + email + '\'' +
                '}';
    }
}
