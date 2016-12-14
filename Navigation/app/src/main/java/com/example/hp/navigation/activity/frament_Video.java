package com.example.hp.navigation.activity;

import android.content.IntentFilter;
import android.content.SharedPreferences;
import android.media.MediaPlayer;
import android.net.Uri;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentActivity;
import android.support.v4.content.LocalBroadcastManager;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.FrameLayout;
import android.widget.LinearLayout;
import android.widget.MediaController;
import android.widget.TextView;
import android.widget.VideoView;

import com.navigation.drawer.activity.R;

import static android.content.Context.MODE_PRIVATE;


public class frament_Video extends Fragment {
    private MediaController mediaController;
    VideoView vidView;
    private int position = 0;
    FrameLayout videoLayout;
    public TextView noVideo;
    String myvideo;


    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // TODO Auto-generated method stub

        View view = inflater.inflate(R.layout.fragment_vedio, container, false);
        vidView = (VideoView)view.findViewById(R.id.myVideo);
        noVideo=(TextView) view.findViewById(R.id.noVideoText);
        videoLayout=(FrameLayout) view.findViewById(R.id.videolayout);
        SharedPreferences pref = getActivity().getSharedPreferences("MyPref", MODE_PRIVATE);
         myvideo=pref.getString("myvideo","defult");
        if (mediaController == null) {
            mediaController =  new MediaController(getActivity()){
                @Override
                public void show (int timeout){
                    if(timeout == 3000) timeout = 60000; //Set to desired number
                    super.show(timeout);
                }
            };

            // Set the videoView that acts as the anchor for the MediaController.
            mediaController.setAnchorView(vidView);


            // Set MediaController for VideoView
            vidView.setMediaController(mediaController);
        }
        myvideo=myvideo.replaceAll("\\s","");
        if(myvideo.equals("novideo")){
            videoLayout.setVisibility(LinearLayout.GONE);
            noVideo.setText("There is no video for the Recipe");
        }
        else {
            String vidAddress = "http://10.0.2.2/upload/" + myvideo;
            Uri vidUri = Uri.parse(vidAddress);
            vidView.setVideoURI(vidUri);
            vidView.requestFocus();
        }

        // When the video file ready for playback.
        vidView.setOnPreparedListener(new MediaPlayer.OnPreparedListener() {

            public void onPrepared(MediaPlayer mediaPlayer) {
                vidView.seekTo(position);
                  if (position == 0) {
                        vidView.start();
                   }

                // When video Screen change size.
                mediaPlayer.setOnVideoSizeChangedListener(new MediaPlayer.OnVideoSizeChangedListener() {
                    @Override
                    public void onVideoSizeChanged(MediaPlayer mp, int width, int height) {

                        // Re-Set the videoView that acts as the anchor for the MediaController
                        mediaController.setAnchorView(vidView);

                    }
                });
            }

        });
        return view;
    }

    // When you change direction of phone, this method will be called.
    // It store the state of video (Current position)
    @Override
    public void onSaveInstanceState(Bundle savedInstanceState) {
        super.onSaveInstanceState(savedInstanceState);

        // Store current position.
        savedInstanceState.putInt("CurrentPosition", vidView.getCurrentPosition());
        vidView.pause();
    }


    // After rotating the phone. This method is called.
    // After rotating the phone. This method is called.

    @Override
    public void onActivityCreated(Bundle savedInstanceState) {
        super.onActivityCreated(savedInstanceState);
        if (savedInstanceState != null) {
            position = savedInstanceState.getInt("CurrentPosition");
            vidView.seekTo(position);

        }

        if (mediaController == null) {
            mediaController =  new MediaController(getActivity()){
                @Override
                public void show (int timeout){
                    if(timeout == 3000) timeout = 60000; //Set to desired number
                    super.show(timeout);
                }
            };

            // Set the videoView that acts as the anchor for the MediaController.
            mediaController.setAnchorView(vidView);


            // Set MediaController for VideoView
            vidView.setMediaController(mediaController);
        }
        myvideo=myvideo.replaceAll("\\s","");
        if(myvideo.equals("novideo")){
            videoLayout.setVisibility(LinearLayout.GONE);
            noVideo.setText("There is no video for the Recipe");
        }
        else {
            String vidAddress = "http://10.0.2.2/upload/" + myvideo;
            Uri vidUri = Uri.parse(vidAddress);
            vidView.setVideoURI(vidUri);
            vidView.requestFocus();
        }

        // When the video file ready for playback.
        vidView.setOnPreparedListener(new MediaPlayer.OnPreparedListener() {

            public void onPrepared(MediaPlayer mediaPlayer) {
                vidView.seekTo(position);
                if (position == 0) {
                    vidView.start();
                }

                // When video Screen change size.
                mediaPlayer.setOnVideoSizeChangedListener(new MediaPlayer.OnVideoSizeChangedListener() {
                    @Override
                    public void onVideoSizeChanged(MediaPlayer mp, int width, int height) {

                        // Re-Set the videoView that acts as the anchor for the MediaController
                        mediaController.setAnchorView(vidView);

                    }
                });
            }

        });
    }



}