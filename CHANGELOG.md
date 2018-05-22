
- ywj Mon May 21 14:47:33 2018    Update posts alter color at teacher page to distinguish no-rate rate and comment status

- ywj Mon May 21 14:31:18 2018    Make type btn at classmate posts smaller

- ywj Mon May 21 11:12:16 2018    Update score calculate method 8*优＋0.5*4＝2赞＋1comment
###### ＊ 学生端更新分数计算公式
- ywj Sun May 20 22:47:46 2018    Add basic assort at classmate posts page

- ywj Mon May 14 10:27:53 2018    Remove 360 viewer temporarily, because it's unsupport on students computer, will restart when update student hardware system.
###### ＊ 学生端暂时停止720图片，因为学生机房电脑硬件不支持
- ywj Mon May 14 09:28:58 2018    Update best post files

- ywj Mon May 14 09:07:51 2018    Add 360 viewer files

- ywj Mon May 14 06:32:57 2018    Add 360 image viewer at student login page
###### ＊ 学生端添加学校的720展示，以及添加优秀作品在其中
- ywj Fri May 11 22:13:44 2018    Add data report at admin dashboard page
###### ＊ 管理端展示两个年级的每节课交作业数和点赞数，使用chart.js 
- ywj Fri Apr 27 07:07:25 2018    Add count mark comment rate num for student and show score
###### ＊ 教师端显示期末分数统计的公式
- ywj Wed Apr 25 09:45:01 2018    Update teacher posts view and student classmate post view

- ywj Tue Apr 24 09:57:26 2018    Update student reminder alert

- ywj Mon Apr 23 09:55:41 2018    Enable list post for admin export page
###### ＊ 管理端制造列出和导出学生作品页面，但没有找到实际自动导出文件的方法。
- ywj Fri Apr 20 07:33:00 2018    Add lock and unlock logic at admin student account manage need add is_lock column at production server database
###### ＊ 管理端添加锁定和解锁学生，适用于转出学生等
- ywj Fri Apr 20 06:26:52 2018    Enable reset student password

- ywj Fri Apr 20 06:06:18 2018    Change git language to php

- ywj Thu Apr 19 16:29:26 2018    Update student list

- ywj Thu Apr 19 15:27:50 2018    Update student list view remove tab logic
###### ＊ 移除学生端tab方式切换是否交作业的状态做法
- ywj Thu Apr 19 07:34:16 2018    Update thumb likes function

- ywj Tue Apr 17 22:00:44 2018    Change student post list use thumb logic

- ywj Tue Apr 17 16:31:50 2018    re changes

- ywj Tue Apr 17 16:25:41 2018    update classmate posts

- ywj Tue Apr 17 16:23:51 2018    re add changes

- ywj Tue Apr 17 10:36:03 2018    revert changes

- ywj Tue Apr 17 09:19:41 2018    Update thumbs logic to create real small pic and load it
###### ＊ 使用实在的创建的缩略图
- ywj Wed Apr 11 09:32:46 2018    revert to imagick driver

- ywj Wed Apr 11 09:08:41 2018    switch to gd image driver

- ywj Wed Apr 11 08:59:20 2018    remove less file

- ywj Wed Apr 11 08:38:10 2018    add like function

- ywj Fri Mar 30 23:57:42 2018    almost finished add or cancel mark to classmate post
###### ＊ 学生端实现点赞和取消点赞的功能
- ywj Thu Mar 29 10:24:36 2018    revert cache the post images

- ywj Wed Mar 28 16:42:12 2018    add more time for cache image files

- ywj Tue Mar 27 23:43:22 2018    Success use package intervention/image and cache to display thumbnails for posts maybe you can write a article to record this next step is to update school code and environment and the next is to develop like function
###### ＊ 使用Intervention/image cache的方法，在每次请求图片或者预览时动态生成缩略图，但本机测试很好，在校园内就出现了问题，一个页面24张图，不确定每次能加载多少张，整体情况偏差，所以最终放弃，采用实际目录下创建相应尺寸的缩略图。
- ywj Thu Mar 22 11:12:07 2018    pagination for classmate posts
###### ＊ 给学生查看同学的作品分页
- ywj Wed Mar 21 08:38:05 2018    remove default username and password setting just for test

- ywj Wed Mar 21 08:33:34 2018    make classmate post list order by desc

- ywj Wed Mar 21 08:27:13 2018    add three office replace icon and resort classmate posts list
###### ＊ 使用图标替换不能预览的office文件
- ywj Tue Mar 20 10:08:52 2018    update site title and list larger pic for classmate posts

- ywj Sat Mar 10 23:11:14 2018    add classmate post browse and update make only one lesson log with one teacher / lesson / class
###### ＊ 限制一个老师一节课一个班只会有一条课堂记录
- ywj Fri Jan 19 11:15:50 2018    增加点我按钮

- ywj Fri Jan 5 15:35:05 2018 add loading gif

- ywj Mon Dec 25 22:56:52 2017    add unqualified  rate level for student re submit work

- ywj Mon Dec 25 10:34:19 2017    enable upload txt file

- ywj Mon Dec 25 10:26:02 2017    a

- ywj Mon Dec 25 10:24:07 2017    a

- ywj Mon Dec 25 10:22:32 2017    enable add lesson

- ywj Mon Dec 25 07:16:19 2017    enable upload students list

- ywj Fri Dec 15 07:32:50 2017    update js and file input version

- ywj Tue Dec 12 22:58:12 2017    update login page view

- ywj Tue Dec 12 22:44:51 2017    enable add comment and rate at lesson log page

- ywj Mon Dec 11 21:34:03 2017    add file filter when upload posts

- ywj Mon Dec 11 11:15:31 2017    add respond .js

- ywj Mon Dec 11 09:31:42 2017    add new database sql file

- ywj Mon Dec 11 09:29:48 2017    close console.log output

- ywj Mon Dec 11 00:03:55 2017    update post table column and add mark table

- ywj Sun Dec 10 22:46:51 2017    add marks table for student add like for each other
###### ＊ 添加点赞功能。
- ywj Fri Dec 8 19:17:29 2017 update some views

- ywj Fri Dec 8 10:22:57 2017 update teacher home

- ywj Fri Dec 8 10:20:10 2017 Merge branch 'develop'

- ywj Fri Dec 8 10:17:56 2017 copy multi auth web route

- ywj Fri Dec 8 10:16:26 2017 Merge branch '20171104_MultiAuth' into develop

- ywj Fri Dec 8 10:08:35 2017 update pic show and admin manage users account

- ywj Thu Dec 7 16:33:15 2017 Merge branch 'develop'

- ywj Thu Dec 7 16:25:07 2017 merge multiauth branch

- ywj Thu Dec 7 16:23:33 2017 Merge branch 'develop' into 20171104_MultiAuth

- ywj Thu Dec 7 16:22:30 2017 add ignore larval log

- ywj Thu Dec 7 16:20:34 2017 add database sql file

- ywj Thu Dec 7 16:18:33 2017 add markdown editor and phpword repository but not sure it will works for me
###### ＊ 尝试phpword实现office文件预览，最终失败。
- ywj Wed Nov 15 11:17:20 2017    update student lesson post page

- ywj Wed Nov 8 22:31:53 2017 enabled reset user password

- ywj Mon Nov 6 13:59:09 2017 update admin and teacher pages with new change

- ywj Mon Nov 6 00:17:42 2017 enable login and logout with three different user type

- ywj Sat Nov 4 00:07:19 2017 resort the database struct and change to multi auth admin/login  teacher/login student/login
###### ＊ 重新整理拆分了登陆功能为admin teacher student三个不同入口和验证
- ywj Sun Oct 29 23:54:12 2017    use bootstrap file input initial preview to show the uploaded post and zoom it suitable
###### ＊ 学生端上传组件加载默认或者已提交作品预览
- ywj Sat Oct 28 22:43:37 2017    enable upload md images and links

- ywj Fri Oct 27 23:58:30 2017    add markdown plugin enable add edit help document and show at students page
###### ＊ 教师端可以加载markdown插件，可以编写MD文档并在学生端展示。
- ywj Thu Oct 26 17:19:36 2017    enable reset sudents password at admin students list page
###### ＊ 管理端学生密码重置
- ywj Wed Oct 25 21:53:06 2017    add reset password function

- ywj Sun Sep 10 16:07:39 2017    finished import students and create account
###### ＊ 管理端学生账户导入完成
- ywj Fri Sep 8 06:17:49 2017 update git ignore

- ywj Fri Sep 8 06:15:38 2017 add ignore

- ywj Thu Sep 7 22:38:54 2017 start build page manage student account
###### ＊ 管理端学生账户管理
- ywj Wed Sep 6 18:00:18 2017 link the history posts at student main page

- ywj Thu Jun 1 11:27:36 2017 enable switch class and show different data when looking lesson log history
###### ＊ 教师端查看上课历史记录以及学生作品
- ywj Thu May 18 22:39:33 2017    Student post page enable open the post img

- ywj Thu May 18 21:24:56 2017    Update student list view in teacher take class

- ywj Thu May 18 17:39:52 2017    Polish teacher/takeclass and student pages

- ywj Thu May 11 07:28:45 2017    Create student history posts page

- ywj Tue May 9 16:05:02 2017 Add feedback to the student upload page
###### ＊ 添加提交文件组件
- ywj Tue May 9 15:01:49 2017 Make bootstrap file input enable zh language

- ywj Tue May 9 09:55:17 2017 Adjust teacher and student page views

- ywj Mon May 8 09:59:11 2017   Update student main page

- ywj Thu May 4 22:48:28 2017   Partials student list and make tab switch panel works
###### ＊ 弹窗展示学生作品，TAB切换是否提交作业名单
- ywj Thu May 4 22:03:33 2017   Enable pop a modal when click a student post

- ywj Wed May 3 21:50:36 2017   Do more update with teacher take class page

- ywj Wed May 3 06:17:11 2017     Student enable uploads picture and will showing at teacher take class page
###### ＊ 使用图形化数据库工具导出结构到mysql
- ywj Thu Apr 27 23:39:38 2017    Export sql file from MySQL workbench and import to the database, make seeder works well, make all the exists function works well

- ywj Wed Apr 26 09:08:56 2017    If teacher has one lesson log already, the page will redirect to take class page directly

- ywj Tue Apr 25 22:49:23 2017    Enable close lesson log and redirect back to teacher main page

- ywj Wed Apr 19 18:01:20 2017    Make the student btn bigger, add more info and comment like icon
###### ＊ 创建教师上课页面
- ywj Fri Mar 17 06:16:30 2017    After teacher login into the system, enable select class and subject, and load the sclass students data next we need limit one teacher only has one start status lesson log at a time, when a student login in, he will see the lesson details

- ywj Tue Jan 10 07:24:55 2017    Start create teacher page

- ywj Mon Dec 26 06:44:17 2016    Small modifies

- ywj Thu Dec 22 21:57:42 2016    Change "works" to "posts" add roles and run well
###### ＊ 登陆
- ywj Sun Dec 11 23:36:16 2016    Use username to login

- ywj Sun Dec 4 20:51:40 2016     Update language and comment area with work title

- ywj Sun Dec 4 20:32:57 2016     Modify read me changelog

- ywj Sun Dec 4 20:27:16 2016     Do the exercise as this [Tutorial](https://github.com/johnlui/Learn-Laravel-5/issues)

- ywj Mon Nov 28 23:05:35 2016    Update readme file

- ywj Mon Nov 28 22:55:40 2016    Merge branch 'master' of https://github.com/huanhuashengling/our-information-class

- ywj  Mon Nov 28 22:52:48 2016    Update README.md

- ywj  Mon Nov 28 22:51:22 2016    Initial commit

- ywj Mon Nov 28 22:36:12 2016    First commit our-information-class