<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<?php
if( isset( $_POST['build_zip'] ) ) {
	// Get real path for our folder
	$dir = $_POST['dir'];
	include_once $dir.'/processor/index.php';

	$rootPath = realpath( $dir );

	foreach ( $processor_commands as $command => $command_data ) {

		$zip = new ZipArchive();

		$zipname  = isset( $command_data['slug'] ) ? $command_data['slug'] : str_replace( ' ', '-', strtolower( $command_data['name'] ) );
		$zip->open(trim($dir,'/').'/processor/build/'.$zipname.'.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);

		$zip->addEmptyDir($zipname);

		// Create recursive directory iterator
		/** @var SplFileInfo[] $files */
		$files = new RecursiveIteratorIterator(
			new RecursiveDirectoryIterator($rootPath),
			RecursiveIteratorIterator::LEAVES_ONLY
		);

		if( isset( $command_data['exclude'] ) ) {
			foreach ( $command_data['exclude'] as $k => $excluded_file ) {
				$command_data['exclude'][$k] = str_replace( '/','\\', trim($dir,'/').'/'.$excluded_file) ;
			}
		}

		foreach ($files as $name => $file)
		{
			if( isset( $command_data['exclude'] ) ) {
				if( str_replace( $command_data['exclude'], array(), $file->getPath() ) !== $file->getPath() ) {
					continue;
				}
			}

			// Skip directories (they would be added automatically)
			if (!$file->isDir())
			{
				// Get real and relative path for current file
				$filePath = $file->getRealPath();
				$relativePath = substr($filePath, strlen($rootPath) + 1);

				// Add current file to archive

				$zip->addFile( $filePath, $zipname.'/'.$relativePath);
			}
		}


		// Zip archive will be created only after closing object
		$zip->close();


		if ($zip->open(trim($dir,'/').'/processor/build/'.$zipname.'.zip') === TRUE) {

		    if( isset( $command_data['change'] ) ) {
				foreach ( $command_data['change'] as $filename => $file_data ) {
					foreach ( $file_data as $old_data => $new_data ) {

					    //Read contents into memory
						$oldContents = $zip->getFromName($zipname.'/'.$filename );

						//Modify contents:
						$newContents = str_replace($old_data, $new_data, $oldContents);

						//Delete the old...
						$zip->deleteName( $zipname.'/'.$filename );

						//Write the new...
						$zip->addFromString( $zipname.'/'.$filename , $newContents);
					}
				}
			}
            //And write back to the filesystem.
            $zip->close();
        }
	}
	// Initialize archive object

}

?>
<form action="" method="post">
	<input type="text" name="dir">
	<input type="submit" name="build_zip" value="Build">
</form>
</body>
</html>