@extends('layouts.website')

@section('content')
<!-- Main Section -->
<main class="main">
   <section class="section banner banner-section">
      <div class="container banner-column">
         
         <div class="banner-inner">
            <h1 class="heading-xl">Youtube: Converter</h1>
            <p class="paragraph">
               The best free and fast YouTube converter in mp3, mp4 and other formats!
            </p>

            <section class="newsletter">
              <div class="container">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="content">
                      <div class="input-group">
                        <input type="email" class="form-control" name="" placeholder="URL keywords......">
                        <span class="input-group-btn">
                     
                         <select class="list-format">
                           <option class="list-item"> mp3</option>
                           <option class="list-item"> mp3 hd</option>
                           <option class="list-item" >mp4</option>
                           <option class="list-item" >mp4 hd</option>
                           <option class="list-item" >m4a</option>
                           <option class="list-item" >3gp</option>
                           <option class="list-item" >flv</option>     
                         </select >
                        
                          <a href="#"><button class="btn2" type="submit">OK</button></a>
                        </span>
                      </div>
                      
                    </div>
                  </div>
                </div>
              </div>
            </section>

              <p class="paragraph"> 
              Enter the url of a YouTube video - YouTube videos in the YouTube Converter.
               </p>
          </div>
   </section>
</main>
</div>

 {!!  $pages->data !!}
@endsection
