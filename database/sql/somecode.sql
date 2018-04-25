select posts list for classmate page
select `posts`.`id` as `pid`, `sclasses`.`class_title`, `sclasses`.`enter_school_year`, `post_rates`.`rate`, `posts`.`storage_name`, `students`.`username`, SUM(`marks`.`state_code`) as mark_num from `posts` left join `students` on `posts`.`students_id` = `students`.`id` left join `sclasses` on `students`.`sclasses_id` = `sclasses`.`id` left join `post_rates` on `posts`.`id` = `post_rates`.`posts_id` left join `marks` on `marks`.`posts_id` = `posts`.`id` where `posts`.`students_id` <> 162 group by `posts`.`id`, `sclasses`.`class_title`, `sclasses`.`enter_school_year`, `post_rates`.`rate`, `posts`.`storage_name`, `students`.`username` order by `posts`.`id` desc

 select `posts`.`id` as `pid`, `sclasses`.`class_title`, `sclasses`.`enter_school_year`, `post_rates`.`rate`, `posts`.`storage_name`, `students`.`username`, SUM('marks.state_code') as paidsum from `posts` left join `students` on `posts`.`students_id` = `students`.`id` left join `sclasses` on `students`.`sclasses_id` = `sclasses`.`id` left join `post_rates` on `posts`.`id` = `post_rates`.`posts_id` left join `marks` on `marks`.`posts_id` = `posts`.`id` where `posts`.`students_id` <> 162 group by `posts`.`id`, `sclasses`.`class_title`, `sclasses`.`enter_school_year`, `post_rates`.`rate`, `posts`.`storage_name`, `students`.`username` order by `posts`.`idwe` desc limit 16 offset 0


 
 UPDATE `post_rates` SET `rate`="优" WHERE `rate`="outstanding"
 UPDATE `post_rates` SET `rate`="良" WHERE `rate`="good"
 UPDATE `post_rates` SET `rate`="合格" WHERE `rate`="lower"
 UPDATE `post_rates` SET `rate`="差" WHERE `rate`="unqualified"