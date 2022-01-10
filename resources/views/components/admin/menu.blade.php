<div class="text-lg h-auto overflow-y-auto bg-hls md:w-96 shadow-xl mb-4">
   <a class="block px-4 py-2 my-1 hover:bg-hls-700 text-gray-700 transition duration-300 easy-in-out"
      href="{{ route('admin.dashboard') }}">
         <span>@lang('l.dashboard')</span>
   </a>
   <a class="block px-4 py-2 my-1 hover:bg-hls-700 text-gray-700 transition duration-300 easy-in-out"
      href="{{ route('admin.userManagement.assign') }}">
         <span>@lang('l.roleAssign')</span>
   </a>
   <a class="block px-4 py-2 my-1 hover:bg-hls-700 text-gray-700 transition duration-300 easy-in-out"
      href="{{ route('admin.course.list') }}">
         <span>@lang('l.courseEdit')</span>
   </a>
   <a class="block px-4 py-2 my-1 hover:bg-hls-700 text-gray-700 transition duration-300 easy-in-out"
      href="{{ route('admin.mentors') }}">
         <span>Studiengangleitende</span>
   </a>
   <a class="block px-4 py-2 my-1 hover:bg-hls-700 text-gray-700 transition duration-300 easy-in-out"
      href="{{route('admin.faq')}}">
         <span>@lang('l.faq')</span>
   </a>
</div>
