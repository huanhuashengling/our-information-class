<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <p>尊敬的{{$rowdata["username"]}}同学家长：</p>
    <p>感谢您的信任并提供了您的邮箱地址，现将您孩子到目前为止信息技术课堂的作业完成情况以及分数报告给您。<br>
    本学期{{$term["grade_key"]}}{{$sclass->class_title}}班共计上课{{count($lessonLogs)}}节(有些课是两课时)。{{$rowdata["username"]}}同学共提交了{{$rowdata["postedNum"]}}次信息课课堂作业。<br>
    其中{{$rowdata["rateYouNum"]}}节评为了优等，每个计8分，其中有{{$rowdata["effectMarkNum"]}}个有效赞，记为{{$rowdata["effectMarkNum"]*0.5}}分，其中有{{$rowdata["commentNum"]}}次作业有老师评语，计{{$rowdata["commentNum"]}}分。合计分数为{{$rowdata["scoreCount"]}}分。<br>
    课程列表如下：</p>
    <ol>
    @php
        foreach ($lessonLogs as $key => $lessonLog) {
            echo "<li>" . $lessonLog->title."（". $lessonLog->subtitle .")</li>";
        }
    @endphp
    </ol>
    <br>具体作业文件请查看附件。
    <hr>
    <br>注意：
    <ol>
        <li>图片文件可以直接预览。</li>
        <li>word ppt excel文件可以直接在邮件中预览，也可以下下来查看。</li>
        <li>.sb2后缀的文件为Scratch 2.0的导出文件，<a href="https://baike.baidu.com/item/Scratch/15493636?fr=aladdin" target="_blank" rel="nofollow">请点击查看软件介绍</a> ，.sb2文件下载之后可以<a href="https://scratch.mit.edu/projects/editor/?tip_bar=home" target="_blank" rel="nofollow">在官网上加载运行</a>
        </li>
        <li>运行.sb2也可安装离线编辑器，下载安装步骤，第一步 <a href="http://get.adobe.com/air/" target="_blank" rel="nofollow">点击下载Adobe Air</a> 第二步 <a href="https://scratch.mit.edu/scratchr2/static/sa/Scratch-461.exe" target="_blank" rel="nofollow">点击下载Scratch 2.0编辑器</a>
        </li>
        <li><a href="https://wj.qq.com/s/2879949/dc2e/" target="_blank" rel="nofollow">请您提供宝贵的意见</a></li>
    </ol>
<p>谢谢<br>
燕山小学信息组OIC</p>
</body>
</html>
<!--
 "users_id" => "431"
  "email" => "shengling_2005@163.com"
  "username" => "蔡诗慧"
  "postedNum" => "9"
  "markNum" => "34"
  "effectMarkNum" => "18"
  "unPostedNum" => "0"
  "commentNum" => "0"
  "rateYouNum" => "9"
  "rateLiangNum" => "0"
  "rateHeNum" => "0"
  "rateChaNum" => "0"
  "scoreCount" => "81"
  -->