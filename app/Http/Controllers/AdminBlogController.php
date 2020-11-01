<?php

namespace App\Http\Controllers;

use App\Blog;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateValidationRequest;
class AdminBlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

  public function index()
    {
        $blogs = Blog::orderBy('id','desc')->get();
        return view('admin.blog.index',compact('blogs'));
    }


    public function create()
    {
        return view('admin.blog.create');
    }


    public function store(UpdateValidationRequest $request)
    {
        // dd($request);
        $blog = new Blog();
        $data = $request->all();

        if ($file = $request->file('photo')) 
        {      
            $name = time().$file->getClientOriginalName();
            $file->move('assets/images',$name);           
            $data['photo'] = $name;
        } 
        if (!empty($request->meta_tag)) 
        {
            $data['meta_tag'] = implode(',', $request->meta_tag);       
        }  
        if ($request->secheck == "") 
        {
            $data['meta_tag'] = null;
            $data['meta_description'] = null;         
        } 

        $name = $data['title'];
        $i = 1;
        while(Blog::where('slug', str_slug($name, '-'))->exists()){
            $name = $data['title'].' '.$i;
            $i++;
        }
        
        $data['slug'] = str_slug($name, '-');

        if($request->hasFile('filenames')){
            foreach ($request->filenames as $reg_certificate_file){
      
      
            $filenameWithExt = $reg_certificate_file->getClientOriginalName();
            $name = pathinfo($filenameWithExt, PATHINFO_FILENAME);
      
            $filename = str_replace(' ','',$name).'_'.time() . '.' . $reg_certificate_file->getClientOriginalExtension();
            $path = $reg_certificate_file->storeAs('public/blog_files', $filename);
            
            $d[] = $filename;
      
            }
           
      
            $data['filename']= json_encode($d);
        }        


        $blog->fill($data)->save();
        return redirect()->route('admin-blog-index')->with('success','New Blog Added Successfully.');
    }


    public function fileshow($d)
    {
        // dd($id);
        // $c= CareerCandidate::findOrFail($id);
        
        try{
            $path = \Storage::get('public/blog_files/'.$d);
            $mimetype = \Storage::mimeType('public/blog_files/'.$d);

            return \Response::make($path, 200, ['Content-Type' => $mimetype]);
        }
        catch (\Exception $e) {
            abort(404);
        }
    }


    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        if($blog->meta_tag != null)
        {
            $metatags = explode(',', $blog->meta_tag);            
        }
        return view('admin.blog.edit',compact('blog','metatags'));
    }

    public function update(UpdateValidationRequest $request, $id)
    {
        $blog = Blog::findOrFail($id);
        $data = $request->all();

            if ($file = $request->file('photo')) 
            {              
                $name = time().$file->getClientOriginalName();
                $file->move('assets/images',$name);
                if($blog->photo != null)
                {
                    if (file_exists(public_path().'/assets/images/'.$blog->photo)) {
                        unlink(public_path().'/assets/images/'.$blog->photo);
                    }
                }            
            $data['photo'] = $name;
            } 
        if (!empty($request->meta_tag)) 
         {
            $data['meta_tag'] = implode(',', $request->meta_tag);       
         }  
        if ($request->secheck == "") 
         {
            $data['meta_tag'] = null;
            $data['meta_description'] = null;         
         } 

         if($request->hasFile('filenames')){
            foreach ($request->filenames as $reg_certificate_file){
      
      
            $filenameWithExt = $reg_certificate_file->getClientOriginalName();
            $name = pathinfo($filenameWithExt, PATHINFO_FILENAME);
      
            $filename = str_replace(' ','',$name).'_'.time() . '.' . $reg_certificate_file->getClientOriginalExtension();
            $path = $reg_certificate_file->storeAs('public/blog_files', $filename);
            
            $d[] = $filename;
      
            }
           
      
            $data['filename']= json_encode($d);
        }        
        
        $blog->update($data);
        return redirect()->route('admin-blog-index')->with('success','Blog Updated Successfully.');
    }


    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        if($blog->photo == null){
        $blog->delete();
        return redirect()->route('admin-blog-index')->with('success','Blog Deleted Successfully.');
        }
                    if (file_exists(public_path().'/assets/images/'.$blog->photo)) {
                        unlink(public_path().'/assets/images/'.$blog->photo);
                    }
        $blog->delete();
        return redirect()->route('admin-blog-index')->with('success','Blog Deleted Successfully.');
    }
}
