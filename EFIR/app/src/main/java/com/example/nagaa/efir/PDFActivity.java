package com.example.nagaa.efir;

import android.content.Intent;
import android.content.pm.PackageManager;
import android.graphics.Bitmap;
import android.graphics.drawable.BitmapDrawable;
import android.graphics.drawable.Drawable;
import android.net.Uri;
import android.os.Environment;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.content.FileProvider;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;
import com.itextpdf.text.Document;
import com.itextpdf.text.DocumentException;
import com.itextpdf.text.Image;
import com.itextpdf.text.Paragraph;
import com.itextpdf.text.pdf.PdfWriter;
import com.kofigyan.stateprogressbar.StateProgressBar;

import net.gotev.uploadservice.MultipartUploadRequest;
import net.gotev.uploadservice.UploadNotificationConfig;

import java.io.ByteArrayOutputStream;
import java.io.File;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.OutputStream;
import java.util.List;
import java.util.UUID;

import static com.google.android.gms.common.internal.safeparcel.SafeParcelable.NULL;

public class PDFActivity extends AppCompatActivity {
EditText name,aadhar,phonenum;
String Name,Aaadhar,Phonenum;
Button submit;
StateProgressBar stateProgressBar;
String[] progDescription={"Case\nDetails","Complainant\nDetails","Accused\nDetails","Verify"};
    private final String RootURL="http://192.168.0.101/e fir/uploadpdf.php?apiCall=UploadPDF";
private File pdf;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        getActionBar().hide();
        setContentView(R.layout.activity_pdf);
        name=findViewById(R.id.name);
        aadhar=findViewById(R.id.aadhaar);
        phonenum=findViewById(R.id.phone);
        submit=findViewById(R.id.submit);
        stateProgressBar=findViewById(R.id.pbar);
        stateProgressBar.setStateDescriptionData(progDescription);
        stateProgressBar.setAnimationDuration(5);


        submit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Name=name.getText().toString();
                Aaadhar=aadhar.getText().toString();
                Phonenum=phonenum.getText().toString();
                if(Name==NULL)
                {
                    Toast.makeText(PDFActivity.this,"Enter a name",Toast.LENGTH_LONG).show();


                }
                else
                {
                  try {
                      createPDF();

                     // viewPDF();
                      Toast.makeText(PDFActivity.this,"Pdf created successfully",Toast.LENGTH_LONG);
                  }
                  catch (FileNotFoundException e)
                  {
                     e.printStackTrace();
                  }
                  catch (DocumentException d)
                  {
                      d.printStackTrace();
                  }


                }
            }
        });
    }
    private void viewPDF()
    {
        PackageManager packageManager=getPackageManager();
        Intent pdfIntent=new Intent(Intent.ACTION_VIEW);
        pdfIntent.setType("application/pdf");
        List list=packageManager.queryIntentActivities(pdfIntent,PackageManager.MATCH_DEFAULT_ONLY);
        if(list.size()>0)
        {
            Intent intent = new Intent();
            intent.setAction(Intent.ACTION_VIEW);
            intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP|Intent.FLAG_ACTIVITY_NEW_TASK);
            Uri uri = Uri.fromFile(pdf);
            intent.setDataAndType(uri, "application/pdf");
            Uri apk= FileProvider.getUriForFile(PDFActivity.this,PDFActivity.this.getPackageName()+".provider",pdf);
            intent.addFlags(Intent.FLAG_GRANT_READ_URI_PERMISSION);
            intent.setDataAndType(apk, "application/pdf");
            startActivity(intent);
        }
        else
        {
            Toast.makeText(PDFActivity.this,"Download a pdf viewer",Toast.LENGTH_LONG);
        }


    }
   private void createPDF() throws FileNotFoundException, DocumentException
   {
        File doc=new File(Environment.getExternalStorageDirectory() + "/Documents");
        if (!doc.exists()) {
            doc.mkdir();
            Toast.makeText(PDFActivity.this,"A new directory named Documents is made",Toast.LENGTH_LONG).show();
        }
       pdf = new File(doc.getAbsolutePath(),"HelloWorld.pdf");
        OutputStream output = new FileOutputStream(pdf);
        Document document = new Document();
        PdfWriter.getInstance(document, output);
        document.open();
        Drawable d=getResources().getDrawable(R.drawable.username);
       BitmapDrawable bitmapDrawable=(BitmapDrawable) d;
       Bitmap bmp=bitmapDrawable.getBitmap();
       ByteArrayOutputStream outputStream=new ByteArrayOutputStream();
       bmp.compress(Bitmap.CompressFormat.PNG,100,outputStream);
       try {
           Image img = Image.getInstance(outputStream.toByteArray());
           document.add(img);
       }
       catch (Exception e)
       {
           e.printStackTrace();

       }

        document.add(new Paragraph(Name+" "+Aaadhar+" "+Phonenum));
        document.close();
        String dir=pdf.getParent();
        Toast.makeText(PDFActivity.this,dir,Toast.LENGTH_LONG).show();
        if(dir==null)
        {
            Toast.makeText(PDFActivity.this,"File path does not exists",Toast.LENGTH_LONG).show();
        }
        else
        {
             try {
                 new MultipartUploadRequest(PDFActivity.this, UUID.randomUUID().toString(), RootURL).addFileToUpload(dir+"/HelloWorld.pdf", "pdf").addParameter("name", "2-2020").setMaxRetries(2).startUpload();
             }
             catch (Exception e)
             {

                 e.printStackTrace();
             }


        }


    }

    }

