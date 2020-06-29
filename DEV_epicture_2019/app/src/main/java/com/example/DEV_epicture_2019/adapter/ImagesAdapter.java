package com.example.DEV_epicture_2019.adapter;

import android.content.Context;
import android.content.Intent;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.squareup.picasso.Picasso;

import java.io.File;
import java.util.List;

import com.example.DEV_epicture_2019.EpictureApp;
import com.example.DEV_epicture_2019.FullScreenImageActivity;
import com.example.DEV_epicture_2019.R;
import com.example.DEV_epicture_2019.SearchActivity;
import com.example.DEV_epicture_2019.UploadActivity;
import com.example.DEV_epicture_2019.model.Image;
import com.example.DEV_epicture_2019.model.ImageList;
import okhttp3.MediaType;
import okhttp3.MultipartBody;
import okhttp3.RequestBody;
import okhttp3.ResponseBody;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class ImagesAdapter extends RecyclerView.Adapter<ImagesAdapter.ViewHolder> {

    private List<Image> images;
    private Context context;

    public ImagesAdapter(Context context, List<Image> images){
        this.images     = images;
        this.context    = context;
    }

    public class ViewHolder extends RecyclerView.ViewHolder{
        private TextView title, views;
        private ImageView image;
        private Button like_btn;
        public ViewHolder(View itemView) {
            super(itemView);
            title       = itemView.findViewById(R.id.title);
            views       = itemView.findViewById(R.id.views);
            image       = itemView.findViewById(R.id.image);
            like_btn    = itemView.findViewById(R.id.like_btn);
        }
    }


    @Override
    public void onBindViewHolder(final ViewHolder holder, int position) {
        Image image = images.get(position);
        if (image.getTitle() != null)
            holder.title.setText(image.getTitle());
        else
            holder.title.setText("Empty Title");
        holder.views.setText((image.getViews()) + " views");
        Picasso.get().load(image.getLink()).into(holder.image);

        if (image.getFavorite() == true)
            holder.like_btn.setText("Unlike");
        else
            holder.like_btn.setText("Like");

        holder.like_btn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Call<okhttp3.ResponseBody> request = EpictureApp.getApi().favImage(
                        images.get(holder.getAdapterPosition()).getId());
                request.enqueue(new Callback<ResponseBody>() {
                    @Override
                    public void onResponse(Call<ResponseBody> call, Response<ResponseBody> response) {
                        if (response.isSuccessful()) {
                            images.get(holder.getAdapterPosition()).setFavorite(!images.get(holder.getAdapterPosition()).getFavorite());
                            notifyItemChanged(holder.getAdapterPosition());
                        }
                    }

                    @Override
                    public void onFailure(Call<ResponseBody> call, Throwable t) {
                        t.printStackTrace();
                    }
                });
            }
        });

        holder.image.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent i = new Intent(v.getContext(), FullScreenImageActivity.class);
                i.putExtra("image_link", images.get(holder.getAdapterPosition()).getLink());
                i.putExtra("image_title", images.get(holder.getAdapterPosition()).getTitle());
                i.putExtra("image_views", images.get(holder.getAdapterPosition()).getViews());
                v.getContext().startActivity(i);
            }
        });
    }

    @Override
    public ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View itemView = LayoutInflater.from(parent.getContext())
                .inflate(R.layout.item_image, parent, false);
        return new ViewHolder(itemView);
    }
    @Override
    public int getItemCount() {
        return images.size();
    }
}
