package com.example.DEV_epicture_2019;

import com.example.DEV_epicture_2019.model.AccessToken;
import com.example.DEV_epicture_2019.model.ImageList;
import com.example.DEV_epicture_2019.model.Profile;

import okhttp3.MultipartBody;
import okhttp3.ResponseBody;
import retrofit2.Call;
import retrofit2.http.DELETE;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.GET;
import retrofit2.http.Headers;
import retrofit2.http.Multipart;
import retrofit2.http.POST;
import retrofit2.http.Part;
import retrofit2.http.Path;
import retrofit2.http.Query;
import retrofit2.http.Url;

public interface ApiInterface {

    @Headers("Authorization: Client-ID " + ApiConstants.clientId)

    @GET("account/me/settings")
    Call<Profile> getUserProfile();

    @GET("gallery/search/?q_type=png")
    Call<ImageList> getImages(@Query("q") String q);

    @GET("account/me/images")
    Call<ImageList> getUserImages();

    @GET("account/me/favorites")
    Call<ImageList> getUserFavorites();

    @Multipart
    @POST("image")
    Call<ResponseBody> postImage(@Part MultipartBody.Part file, @Query("title") String title);

    @POST("image/{id}/favorite")
    Call<ResponseBody> favImage(@Path("id") String id);


    @POST("account/me/settings")
    Call<Profile> setShowMatureUserProfile(Boolean showMature);

    @FormUrlEncoded
    @POST("image/{id}")
    Call<ResponseBody> updateImage(@Path("id") String id, @Field("title") String title);

    @DELETE("image/{id}")
    Call<ResponseBody> deleteImage(@Path("id") String id);

    @FormUrlEncoded
    @POST
    Call<AccessToken> refreshToken(@Url String url,
                                   @Field("refresh_token") String refresh_token,
                                   @Field("client_id") String client_id,
                                   @Field("client_secret") String client_secret,
                                   @Field("grant_type") String grant_type);


}