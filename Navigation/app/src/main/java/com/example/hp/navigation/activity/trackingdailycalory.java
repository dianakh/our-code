package com.example.hp.navigation.activity;

import android.content.Intent;
import android.content.SharedPreferences;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.os.Bundle;
import android.support.annotation.NonNull;
import android.support.design.widget.AppBarLayout;
import android.support.design.widget.NavigationView;
import android.support.v4.view.GravityCompat;
import android.support.v4.view.ViewCompat;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarDrawerToggle;
import android.support.v7.app.AppCompatActivity;
import android.text.format.Time;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.ImageView;
import android.widget.RelativeLayout;
import android.widget.TextView;
import android.os.Bundle;
import android.support.design.widget.FloatingActionButton;
import android.support.design.widget.Snackbar;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.View;
import android.view.Menu;
import android.view.MenuItem;

import android.os.Bundle;
import android.support.annotation.NonNull;
import android.support.design.widget.AppBarLayout;
import android.support.design.widget.NavigationView;
import android.support.v4.view.GravityCompat;
import android.support.v4.view.ViewCompat;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarDrawerToggle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.ImageView;
import android.widget.RelativeLayout;
import android.widget.TextView;

import com.github.sundeepk.compactcalendarview.CompactCalendarView;

import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Date;
import java.util.Locale;
import java.util.TimeZone;


import com.github.sundeepk.compactcalendarview.CompactCalendarView;
import com.navigation.drawer.activity.R;

import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.Locale;
import java.util.TimeZone;

public class trackingdailycalory extends BaseActivity  {
    public static TextView Text;
    private AppBarLayout mAppBarLayout;
    private SimpleDateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd", /*Locale.getDefault()*/Locale.ENGLISH);
    private CompactCalendarView mCompactCalendarView;
    private boolean isExpanded = false;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
       // setContentView(R.layout.activity_trackingdailycalory);
        getLayoutInflater().inflate(R.layout.activity_trackingdailycalory, frameLayout);

        /**
         * Setting title and itemChecked
         */
        mDrawerList.setItemChecked(position, true);
        //setTitle("daily traking");
     //   Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
     //   setSupportActionBar(toolbar);
        Text = (TextView) findViewById(R.id.text);
        SQLiteDatabase sqLiteDatabase;
        recipeDbHelper userDbHelper;
        Cursor cursor;
        userDbHelper = new recipeDbHelper(getApplicationContext());
        sqLiteDatabase = userDbHelper.getReadableDatabase();
        cursor=userDbHelper.getinformationtracking(sqLiteDatabase);

        if(cursor.moveToFirst())
        {
            do {
                String bmr=cursor.getString(0);

                Text.setText(bmr);


            }while (cursor.moveToNext());

        }

        mAppBarLayout = (AppBarLayout) findViewById(R.id.app_bar_layout);

        // Set up the CompactCalendarView
        mCompactCalendarView = (CompactCalendarView) findViewById(R.id.compactcalendar_view);

        // Force English
        mCompactCalendarView.setLocale(TimeZone.getDefault(), Locale.ENGLISH);

        mCompactCalendarView.setShouldDrawDaysHeader(true);

        mCompactCalendarView.setListener(new CompactCalendarView.CompactCalendarViewListener() {
            @Override
            public void onDayClick(Date dateClicked) {
                setSubtitle(dateFormat.format(dateClicked));
              //get selected date from calender
                String time_str = dateFormat.format(dateClicked);



                String[] s = time_str.split("-");


                int year = Integer.parseInt(s[0]);
                int month = Integer.parseInt(s[1]);
                int day = Integer.parseInt(s[2]);

               // String d=dateFormat.format(dateClicked);
               //  Date f= dateClicked;
               //   int day= f.getDay();
                //  int month=f.getMonth();
                //  int year=f.getYear();

                Log.d("day",day+"");
                Log.d("month",month+"");
                Log.d("year",year+"");
                //get current date
                SimpleDateFormat dateFormat1 = new SimpleDateFormat("yyyy/MM/dd HH:mm:ss");
                Calendar cal = Calendar.getInstance();
             //   System.out.println("time => " + dateFormat1.format(cal.getTime()));
                String time_str1 = dateFormat1.format(cal.getTime());

                String[] s1 = time_str1.split(" ");

                int mYear = Integer.parseInt(s1[0].split("/")[0]);
                int mMonth = Integer.parseInt(s1[0].split("/")[1]);
                int mDay = Integer.parseInt(s1[0].split("/")[2]);
                Log.d("mday",mDay+"");
                Log.d("mmonth",mMonth+"");
                Log.d("myear",mYear+"");

                if(year>mYear){
                    setSubtitle(dateFormat.format(dateClicked));
                    Log.d("year larger",year+mYear+"");
                }

                else {

                    if(month>mMonth){
                        setSubtitle(dateFormat.format(dateClicked));
                        Log.d("month larger",month+mMonth+"");
                    }

                    else {
                               if(mMonth==month) {
                                   if (day > mDay) {
                                       setSubtitle(dateFormat.format(dateClicked));
                                       Log.d("day larger", day + mDay + "");
                                   } else {
                                       Log.d("not larger", "");
                                       SharedPreferences pref = getApplicationContext().getSharedPreferences("MyPref", MODE_PRIVATE);
                                       SharedPreferences.Editor editor = pref.edit();
                                       String date=dateFormat.format(dateClicked);
                                       editor.putString("old_date",date);
                                       // Save the changes in SharedPreferences
                                       editor.commit();
                                       startActivity(new Intent(trackingdailycalory.this, oldTraking.class));

                                   }
                               }
                        else {
                                   SharedPreferences pref = getApplicationContext().getSharedPreferences("MyPref", MODE_PRIVATE);
                                   SharedPreferences.Editor editor = pref.edit();
                                   String date=dateFormat.format(dateClicked);
                                   editor.putString("old_date",date);
                                   // Save the changes in SharedPreferences
                                   editor.commit();
                                   startActivity(new Intent(trackingdailycalory.this, oldTraking.class));
                               }

                    }
                }




            }


            @Override
            public void onMonthScroll(Date firstDayOfNewMonth) {
                setSubtitle(dateFormat.format(firstDayOfNewMonth));
            }
        });

        // Set current date to today
        setCurrentDate(new Date());

        final ImageView arrow = (ImageView) findViewById(R.id.date_picker_arrow);

        RelativeLayout datePickerButton = (RelativeLayout) findViewById(R.id.date_picker_button);

        datePickerButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if (isExpanded) {
                    ViewCompat.animate(arrow).rotation(0).start();
                    mAppBarLayout.setExpanded(false, true);
                    isExpanded = false;
                } else {
                    ViewCompat.animate(arrow).rotation(180).start();
                    mAppBarLayout.setExpanded(true, true);
                    isExpanded = true;
                }
            }
        });
        // jso1(numberAsString);





    }
    public void setCurrentDate(Date date) {
        setSubtitle(dateFormat.format(date));
        if (mCompactCalendarView != null) {
            mCompactCalendarView.setCurrentDate(date);
        }

    }

    @Override
    public void setTitle(CharSequence title) {
        TextView tvTitle = (TextView) findViewById(R.id.title);

        if (tvTitle != null) {
            tvTitle.setText(title);
        }
    }

    public void setSubtitle(String subtitle) {
        TextView datePickerTextView = (TextView) findViewById(R.id.date_picker_text_view);

        if (datePickerTextView != null) {
            datePickerTextView.setText(subtitle);
        }
    }


}


