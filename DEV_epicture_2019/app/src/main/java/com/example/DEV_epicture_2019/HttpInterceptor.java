package com.example.DEV_epicture_2019;


import java.io.IOException;

import okhttp3.Interceptor;
import okhttp3.Request;
import okhttp3.Response;

public class HttpInterceptor implements Interceptor {

    @Override
    public Response intercept(Chain chain) throws IOException {
        Request request = chain.request();

        Request.Builder builder = request.newBuilder();
        builder.header("Accept", "application/json");

        String token = EpictureApp.getInstance().getAccessToken();
        setAuthHeader(builder, token);

        request             = builder.build();
        Response response   = chain.proceed(request);

        return response;
    }

    private void setAuthHeader(Request.Builder builder, String token) {
        if (token != null)
            builder.header("Authorization", String.format("Bearer %s", token));
    }
}